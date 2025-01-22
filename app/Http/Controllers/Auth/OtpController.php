<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OtpController extends Controller
{
    public function showOtpForm($phone)
    {
        return view('auth.otp', ['phone' => $phone]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'numeric', 'digits:4'],
            'phone' => ['required', 'string'],
        ]);
        if ($request->otp == session('otp')) {
            
            $user = User::where('remember_token', session('otp'))->first();
            
            if ($user->remember_token == session('otp')) {
                $updateData = [
                    'email_verified_at' => now(),
                    'updated_at' => now(),
                    'remember_token' => null
                ];
               $data = $user->update($updateData);
                $user->host->update(['status' => 1]);

                Auth::loginUsingId(session('user_id'));

                session()->forget('otp');
                session()->forget('user_id');

                return redirect()->route('host.dashboard');
            } else {
                return redirect()->back()->withErrors(['otp' => 'Invalid OTP or user not found.']);
            }
        } else {
            return redirect()->back()->withErrors(['otp' => 'OTP does not match.']);
        }
    }
}
