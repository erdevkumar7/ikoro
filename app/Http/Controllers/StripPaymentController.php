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

class StripPaymentController extends Controller
{
    public function stripPaymentForm(Request $request)
    {
        $client = Auth::check() && Auth::user()->role === 'user' ? Auth::id() : null;

        if (!$client) {
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

        $gig = Gig::with(['host','task', 'country', 'state', 'city', 'zip', 'equipmentPrice'])->findOrFail($gig_id);
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
            ]);

            if($charge->status === 'succeeded'){
                Booking::create([
                    'task_id' => $gig->task->id,
                    'gig_id' => $gig->id,
                    'country_id' => $gig->country->id,
                    'state_id' => $gig->state->id,
                    'city_id' => $gig->city->id,
                    'zip_id' => $gig->zip->id,
                    'preferred_gender' => $gig->host->gender,
                    'client_id' => $userId,
                    'host_id' => $gig->host->user->id,
                    'price' => $charge->amount / 100,
                    'equipment_id' => $gig->equipmentPrice->equipment_id ?? null,
                    'hours' => $request->duration,
                ]);
            }
          

            return redirect()->route('user.booking')->with('success', 'Payment successfully completed!');
        } catch (CardException $e) {
            return redirect()->back()->withErrors('Card error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error processing payment: ' . $e->getMessage());
        }
    }
}
