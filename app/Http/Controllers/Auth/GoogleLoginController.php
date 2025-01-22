<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();
        if(!$user)
        {
            $user = User::create([
                'name' => $googleUser->name, 
                'email' => $googleUser->email, 
                'password' => Hash::make(rand(000000,999999)),
                'email_verified_at' => now()
            ]);
            $client = Client::create([
                'name' => $user->name,
                'user_id' => $user->id,
            ]);
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
