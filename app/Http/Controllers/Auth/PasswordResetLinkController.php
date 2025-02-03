<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        // $status = Password::sendResetLink(
        //     $request->only('email')
        // );

        // return $status == Password::RESET_LINK_SENT
        //             ? back()->with('status', __($status))
        //             : back()->withInput($request->only('email'))
        //                     ->withErrors(['email' => __($status)]);


        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'We could not find a user with that email address.']);
        }

        $token = app('auth.password.broker')->createToken($user);
        $resetUrl = url('reset-password/' . $token);

        Mail::to($user->email)->send(new ResetPasswordMail($resetUrl));
        return back()->with('status', 'We have emailed your password reset link!');
        // $subject = "Password Reset Request";
        // $message = "Click the link to reset your password: " . $resetUrl;

        // $result = $this->sendmailmail($user->email, $subject, $message);

        // if ($result == 'sent') {
        //     return back()->with('status', 'We have emailed your password reset link!');
        // } else {
        //     return back()->withErrors(['email' => 'Failed to send reset link.']);
        // }
    }

    public function sendmailmail($email, $subject, $message)
    {
        if (mail($email, $subject, $message)) {
            return 'sent';
        } else {
            return 'failed';
        }
    }
}
