<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\PaymentDetail;
use App\Models\Wallet;
use App\Services\WalletService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function topup()
    {
        return view('topup');
    }

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        $data = array(
            "amount" => $request->input("amount") * 100,
            "id" => Auth::user()->id,
            "email" => Auth::user()->email,
            "currency" => "ZAR",
            "callback_url" => route('callback'),
        );

        try {
            return Paystack::getAuthorizationUrl($data)->redirectNow();
            // return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }

    public function bookingCheckOutPage()
    {
        $client = Auth::user()->id ?? "";

        if ($client == "") {
            return redirect()->back();
        } else {
            return view('user.payment.check-out');
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        $wallet = Auth::user()->wallet;
        if (!$wallet) {
            $wallet = Wallet::create([
                'user_id' => Auth::id(),
                'amount' => 0,
            ]);
        }
        $amount = $paymentDetails['data']['amount'] / 100;
        $trx = $paymentDetails['data']['reference'];

        $this->walletService->credit($wallet, $amount, $trx, null, json_encode($paymentDetails['data']));

        Session::flash('message', "topup with amount of " . $amount);
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('user.wallet');
    }

    public function adminGetAllPayment()
    {
        $payments = PaymentDetail::with('booking','user', 'userDetails','gig')
                    ->where('status', 'succeeded')
                    ->orderBy('created_at', 'desc')
                    ->get();        
        return view('admin.payment.index', compact('payments'));
    }

    public function adminGetPaymenByPaymentId($payment_id)
    {
        $payment = PaymentDetail::with('booking', 'user', 'userDetails', 'gig')->where('status', 'succeeded')->findOrFail($payment_id);
        // dd($payment);
         return view('admin.payment.detail', compact('payment'));
    }
}
