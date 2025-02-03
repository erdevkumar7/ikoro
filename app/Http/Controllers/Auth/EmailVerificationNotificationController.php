<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // $request->user()->sendEmailVerificationNotification();
        $user = User::where('email', $request->user()->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We could not find a user with that email address.']);
        }
        
        $verificationUrl = URL::signedRoute('verification.verify', [
            'id' => $user->id,  // User ID
            'hash' => sha1($user->getEmailForVerification()),  // Hashed email address
        ]);

        $subject = "Email Verification";
        $message = "Please click the following link to verify your email: " . $verificationUrl;

        // mail($user->email, $subject, $message);
        $user->sendEmailVerificationNotification();
        
        return back()->with('status', 'verification-link-sent');
    }
}
