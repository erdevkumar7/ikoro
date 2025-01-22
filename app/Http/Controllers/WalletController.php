<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Host;
use App\Models\Wallet;
use App\Services\WalletService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function index(){ 
        $data['wallet'] = Wallet::with(['transactions'])->where("user_id", Auth::id())->first()?->toArray() ?? [];
        
        return view('user.wallet.index', $data);
    }

    public function hostWallet(){ //called by user and host routes
        $data['wallet'] = Wallet::with(['transactions'])->where("user_id", Auth::id())->first()?->toArray() ?? [];
        
        return view('host.wallet.index', $data);
    }

    public function hostWalletAdmin($host_id){ //called by user and host routes
        $data['wallet'] = Wallet::with(['transactions'])->where("user_id", $host_id)->first()?->toArray() ?? [];
        $data['host'] = Host::where("user_id", $host_id)->first();
        return view('admin.wallet.index', $data);
    }

    public function transferToHost($wallet_id, Request $request)
    {
        $amount = $request->input("amount");
        $hostWallet = Wallet::find($wallet_id);
        
        try{
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imagepath = $file->store('uploads', 'public');
            }
            else{
                throw new \Exception('select an image proof.');
            }

            $this->walletService->debit($hostWallet, $amount, 'internal', $imagepath, 'Transfered to host externally');

            Session::flash('message', 'Transfered from host wallet to host successfuly.'); 
            Session::flash('alert-class', 'alert-success'); 

        }
        catch(\Exception $e){
            Session::flash('message', 'Error .'. json_encode($e->getMessage())); 
            Session::flash('alert-class', 'alert-warning');
        }

        return redirect()->back();
    }

}