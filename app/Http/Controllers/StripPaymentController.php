<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Advertise;
use App\Models\Booking;
use App\Models\EquipmentPrice;
use App\Models\Gig;
use App\Models\GigFeature;
use App\Models\PaymentDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Exception\CardException;
use Illuminate\Support\Facades\Session;

class StripPaymentController extends Controller
{
    public function stripPaymentForm(Request $request)
    {
        $clientId = Auth::check() && Auth::user()->role === 'user' ? Auth::id() : null;

        if (!$clientId) {
            return redirect()->route('login')->withErrors(['error' => 'Please login to continue.']);
        }

        if (!session()->has('booking')) {
            // return redirect()->route('booking.page')->withErrors(['error' => 'Your session expired. Please select booking details again.']);
            return redirect()->back()->withErrors(['error' => 'Your session expired. Please select booking details again.']);
        }

        $booking = session('booking');

        return view('user.payment.userPaymentForm', [
            'gigId' => $booking['gig_id'],
            'price' => $booking['price'],
            'duration' => $booking['duration'],
            'operation_time' => $booking['operation_time'],
            'feature_ids' => $booking['feature_ids'],
            'feedback_tool' => $booking['feedback_tool'] ?? null,
            'feedback_tool_value' => $booking['feedback_tool_value'] ?? null,
            'host_notes' => $booking['host_notes'] ?? null,
        ]);
    }



    public function stripPaymentSubmit(Request $request)
    {
        // $userId = (Auth::check() && Auth::user()->role === 'user') ? Auth::id() : ''; // cleaner way
        // $client = User::with('client')->findOrFail($userId);
        // $clientId = $client->client->id;
        // $gig_id =  $request->gig_id;
      
        $userId = (Auth::check() && Auth::user()->role === 'user') ? Auth::id() : null;

        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'Unauthorized']);
        }
    
        if (!session()->has('booking')) {
            return redirect()->back()->withErrors(['error' => 'Your session expired. Please select booking details again.']);
        }
    
        $booking = session('booking');
    
        $client = User::with('client')->findOrFail($userId);
        $clientId = $client->client->id;
        $gig_id = $booking['gig_id'];
        $price = $booking['price'];

        $gig = Gig::with(['host', 'task', 'country', 'state', 'city', 'zip', 'equipmentPrice'])->findOrFail($gig_id);  

        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $token = $request->stripeToken;
            // Charge the user via Stripe
            $charge = Charge::create([
                'amount' => $price * 100, // Convert to cents
                'currency' => 'usd',
                'description' => 'Payment for ' . $gig->title . ' plan',
                'source' => $token,
            ]);

            // dd($request->price);
            // Store payment details in the database
            $paymentDetail = PaymentDetail::create([
                'user_id' => $userId,
                'client_id' => $clientId,
                'gig_id' => $booking['gig_id'],
                'duration' => $booking['duration'],
                'payment_intent_id' => $charge->id,
                'payment_method' => $charge->payment_method,
                'amount' => $charge->amount / 100,
                'currency' => $charge->currency,
                'status' => $charge->status,
                'payment_type' => 'stripe'
            ]);

            if ($charge->status === 'succeeded') {
                $booking = Booking::create([
                    'task_id' => $gig->task->id,
                    'gig_id' => $booking['gig_id'] ?? $gig->id,
                    'country_id' => $gig->country->id,
                    'state_id' => $gig->state->id,
                    'city_id' => $gig->city->id,
                    'zip_id' => $gig->zip->id,
                    'preferred_gender' => $gig->host->gender,
                    'client_id' => $userId,
                    'host_id' => $gig->host->user->id,
                    'price' => $charge->amount / 100,
                    'equipment_name' => $gig->equipment_name ?? null,
                    'duration' => $booking['duration'] ?? null,
                    'operation_time' => $booking['operation_time'] ?? null,
                    'feature_id' => $booking['feature_ids'] ?? null,
                    'feedback_tool' => $booking['feedback_tool'] ?? null,
                    'feedback_tool_value' => $booking['feedback_tool_value'] ?? null,
                    'host_notes' => $booking['host_notes'] ?? null,
                    'payment_detail_id' => $paymentDetail->id,
                ]);
            }
            Session::flash('payment_success', 'Payment successfuly completed!');
            // clear booking session
            session()->forget('booking');
            return redirect()->route('user.booking.byBookingId', $booking->id);
        } catch (CardException $e) {
            // return redirect()->back()->withErrors('Card error: ' . $e->getMessage());
            Session::flash('payment_fail', 'Payment faild!');
            session()->forget('booking');
            return redirect()->route('booking.detail.byGigId', $gig_id);
        } catch (\Exception $e) {
            // return redirect()->back()->withErrors('Error processing payment: ' . $e->getMessage());
            Session::flash('payment_fail', 'Payment faild!');
            session()->forget('booking');
            return redirect()->route('booking.detail.byGigId', $gig_id);
        }
    }
}
