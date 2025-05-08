<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Gig;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PayPalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('services.paypal.client_id'),
                config('services.paypal.secret')
            )
        );

        $this->apiContext->setConfig([
            'mode' => config('services.paypal.settings.mode'),
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'ERROR',
        ]);
    }

    public function createPayment(Request $request)
    {
        $userId = (Auth::check() && Auth::user()->role === 'user') ? Auth::id() : null;

        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'Unauthorized']);
        }

        if (!session()->has('booking')) {
            return redirect()->back()->withErrors(['error' => 'Your session expired. Please select booking details again.']);
        }
        
        $booking = session('booking');
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($booking['price']); // Use validated input
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setDescription('Booking Payment');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('payment.execute'))
            ->setCancelUrl(route('payment.cancel'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($this->apiContext);
            // Redirect user to PayPal
            return redirect()->away($payment->getApprovalLink());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'PayPal error: ' . $e->getMessage());
        }
    }




    public function executePayment(Request $request)
    {
        $userId = (Auth::check() && Auth::user()->role === 'user') ? Auth::id() : null;

        if (!$userId) {
            return redirect()->route('login')->withErrors(['error' => 'Unauthorized']);
        }

        if (!session()->has('booking')) {
            return redirect()->back()->withErrors(['error' => 'Your session expired. Please select booking details again.']);
        }
        $booking = session('booking');
        $paymentId = $request->paymentId;
        $payerId = $request->PayerID;

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);
            
            $client = User::with('client')->findOrFail($userId);
            $clientId = $client->client->id;
            $gigId =  $booking['gig_id'];
            $p_status = $result->getState() === 'approved' ? 'succeeded' : $result->getState();
            $gig = Gig::with(['host', 'task', 'country', 'state', 'city', 'zip', 'equipmentPrice'])->findOrFail($gigId);

            // Save PaymentDetail
            $paymentDetail = PaymentDetail::create([
                'user_id' => $userId,
                'client_id' => $clientId,
                'gig_id' => $booking['gig_id'],
                'duration' => $booking['duration'],
                'payment_intent_id' => $payment->getId(),
                'amount' => $booking['price'],
                'currency' => 'USD',
                'status' => $p_status,
                'payment_type' => 'paypal'
            ]);

            if ($result->getState() === 'approved') {
                // Save Booking
                $booking = Booking::create([
                    'task_id' => $gig->task->id,
                    'gig_id' => $gig->id,
                    'country_id' => $gig->country->id,
                    'state_id' => $gig->state->id,
                    'city_id' => $gig->city->id,
                    'zip_id' => $gig->zip->id,
                    'preferred_gender' => $gig->host->gender,
                    'client_id' => $userId,
                    'host_id' => $gig->host->user->id,
                    'price' => $booking['price'],
                    'equipment_name' => $gig->equipment_name ?? null,
                    'duration' => $booking['duration'] ?? null,
                    'operation_time' => $booking['operation_time'] ?? null,
                    'feature_id' =>  $booking['feature_ids'] ?? null,
                    'feedback_tool' => $booking['feedback_tool'] ?? null,
                    'feedback_tool_value' => $booking['feedback_tool_value'] ?? null,
                    'host_notes' => $booking['host_notes'] ?? null,
                    'payment_detail_id' => $paymentDetail->id,
                ]);

                session()->forget('booking');
                Session::flash('payment_success', 'Payment successfully completed!');
                // return view('user.payment.success');
                return redirect()->route('user.booking.byBookingId', $booking->id);
            }
        } catch (\Exception $ex) {
            session()->forget('booking');
            return back()->withError('Payment execution failed.');
        }

        return back()->withError('Booking failed.');
    }

    public function cancelPayment()
    {
        session()->forget('booking');
        return back()->withError('Payment execution failed.');
    }
}
