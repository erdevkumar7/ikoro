<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('dashboard');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'facebook_id' => $user->id,
                    'password' => Hash::make(rand(000000,999999)),
                    'email_verified_at' => now()
                ]);
                Client::create([
                    'name' => $user->name,
                    'user_id' => $newUser->id,
                ]);
                Auth::login($newUser);
                return redirect()->route('dashboard');
            }
        } catch (Exception $e) {
            print_r($e->getMessage());
            exit;
        }
    }
}
