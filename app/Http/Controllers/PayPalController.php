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
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($request->price); // Use validated input
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
        $paymentId = $request->paymentId;
        $payerId = $request->PayerID;

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);

            if ($result->getState() === 'approved') {
                // Retrieve user data from session  

                if ($result->getState() === 'approved') {
                    // SUCCESSFUL PAYMENT — SAVE TO DB
                    $userId = (Auth::check() && Auth::user()->role === 'user') ? Auth::id() : '';
                    $client = User::with('client')->findOrFail($userId);
                    $clientId = $client->client->id;
                    $gigId = session('booking.gig_id');
                    $duration = session('booking.duration');
                    $operationTime = session('booking.operation_time');
                    $featureIds = session('booking.feature_ids');
                    $price = session('booking.price');
                    $feedback_tool = session('booking.feedback_tool');
                    $feedback_tool_value = session('booking.feedback_tool_value');
                    $host_notes = session('booking.host_notes');

                    $gig = Gig::with(['host', 'task', 'country', 'state', 'city', 'zip', 'equipmentPrice'])->findOrFail($gigId);

                    // Save PaymentDetail
                    $paymentDetail = PaymentDetail::create([
                        'user_id' => $userId,
                        'client_id' => $clientId,
                        'gig_id' => $gigId,
                        'duration' => $duration,
                        'payment_intent_id' => $payment->getId(),                        
                        'amount' => $price,
                        'currency' => 'USD',
                        'status' => $result->getState(),
                        'payment_type' => 'paypal'
                    ]);

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
                        'price' => $price,
                        'equipment_name' => $gig->equipment_name ?? null,
                        'duration' => $duration,
                        'operation_time' => $operationTime,
                        'feature_id' => $featureIds,
                        'feedback_tool' => $feedback_tool,
                        'feedback_tool_value' => $feedback_tool_value,
                        'host_notes' => $host_notes,
                        'payment_detail_id' => $paymentDetail->id,
                    ]);

                    session()->forget('booking');
                    Session::flash('payment_success', 'Payment successfully completed!');
                    // return view('user.payment.success');
                    return redirect()->route('user.booking.byBookingId', $booking->id);
                }
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
