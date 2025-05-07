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
        $client = Auth::check() && Auth::user()->role === 'user' ? Auth::id() : null;

        if (!session()->has('booking')) {
            return redirect()->back()->withErrors(['error' => 'Unauthorized user']);
        }

        $request->validate([
            'gig_id' => 'required|exists:gigs,id',
            'price' => 'required',
            'duration' => 'required',
        ]);

        //    dd($dataa);
        return view('user.payment.userPaymentForm', [
            'gigId' => $request->gig_id,
            'price' => $request->price,
            'duration' => $request->duration,
            'operation_time' => $request->operation_time,
            'feature_ids' => $request->features_ids,
        ]);
    }


    public function stripPaymentSubmit(Request $request)
    {
        $userId = (Auth::check() && Auth::user()->role === 'user') ? Auth::id() : ''; // cleaner way
        $client = User::with('client')->findOrFail($userId);
        $clientId = $client->client->id;
        $gig_id =  $request->gig_id;

        $data = [
            'loggedIn' => $clientId ?? '',
        ];

        $gig = Gig::with(['host', 'task', 'country', 'state', 'city', 'zip', 'equipmentPrice'])->findOrFail($gig_id);
        $data['gig'] = $gig;

        Stripe::setApiKey(config('services.stripe.secret'));
        $token = $request->stripeToken;

        try {
            // Charge the user via Stripe
            $charge = Charge::create([
                'amount' => $request->price * 100, // Convert to cents
                'currency' => 'usd',
                'description' => 'Payment for ' . $gig->title . ' plan',
                'source' => $token,
            ]);


            // dd($request->price);
            // Store payment details in the database
            $paymentDetail = PaymentDetail::create([
                'user_id' => $userId,
                'client_id' => $clientId,
                'gig_id' => $request->gig_id,
                'duration' => $request->duration,
                'payment_intent_id' => $charge->id,
                'payment_method' => $charge->payment_method,
                'amount' => $charge->amount / 100,
                'currency' => $charge->currency,
                'status' => $charge->status,
                'payment_type' => 'stripe'
            ]);

            if ($charge->status === 'succeeded') {
                Booking::create([
                    'task_id' => $gig->task->id,
                    'gig_id' => session('booking.gig_id') ?? $gig->id,
                    'country_id' => $gig->country->id,
                    'state_id' => $gig->state->id,
                    'city_id' => $gig->city->id,
                    'zip_id' => $gig->zip->id,
                    'preferred_gender' => $gig->host->gender,
                    'client_id' => $userId,
                    'host_id' => $gig->host->user->id,
                    'price' => $charge->amount / 100,
                    'equipment_name' => $gig->equipment_name ?? null,
                    'duration' => session('booking.duration') ?? $request->duration,
                    'operation_time' => session('booking.operation_time') ?? $request->operation_time,
                    'feature_id' => session('booking.feature_ids') ?? $request->feature_ids,
                    'feedback_tool' => session('booking.feedback_tool'),
                    'feedback_tool_value' => session('booking.feedback_tool_value'),
                    'host_notes' => session('booking.host_notes'),
                ]);
            }
            Session::flash('payment_success', 'Payment successfuly completed!');
            // clear booking session
            session()->forget('booking');
            return redirect()->route('user.booking');
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
