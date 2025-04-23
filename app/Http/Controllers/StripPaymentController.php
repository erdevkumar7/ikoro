<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Advertise;
use App\Models\EquipmentPrice;
use App\Models\Gig;
use App\Models\GigFeature;
use App\Models\PaymentDetail;
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
        $clientId = (Auth::check() && Auth::user()->role === 'user') ? Auth::id() : ''; // cleaner way
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

            // Store payment details in the database
            // $paymentDetail = PaymentDetail::create([
            //     'escort_id' => Auth::guard('escort')->user()->id,
            //     'ads_id' => $advertisement->id,
            //     'time_duration' => $advertisement->time_duration,
            //     'payment_id' => $charge->id,
            //     'payment_method' => $charge->payment_method,
            //     'amount' => $charge->amount / 100,
            //     'currency' => $charge->currency,
            //     'status' => $charge->status,
            // ]);

            // Calculate the end date based on time duration and created_at
            // $paymentEndDate = $paymentDetail->created_at->addDays($advertisement->time_duration);

            // // Update the escort's activation status and set the active_until date
            // $escort = Auth::guard('escort')->user();
            // if ($escort->active_until > $paymentEndDate) {
            //     $paymentEndDate = $escort->active_until;
            // }

            // $escort->status = true;
            // $escort->active_until = $paymentEndDate;
            // $escort->save();

            return redirect()->route('user.booking')->with('success', 'Payment successfully completed!');
        } catch (CardException $e) {
            return redirect()->back()->withErrors('Card error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error processing payment: ' . $e->getMessage());
        }
    }
}
