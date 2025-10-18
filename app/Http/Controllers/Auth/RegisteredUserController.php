<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Host;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Services\SmsService;
use Exception;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function usercreate(): View
    {
        $data['country'] = DB::table('countries')->get();
        return view('auth.user-register', $data);
    }

    public function hostcreate(): View
    {
        $data['country'] = DB::table('countries')->get();
        $data['tasks'] = DB::table('tasks')->get();
        return view('auth.host-register', $data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $role = $request->role ?? 'user';

        if ($role === 'host') {
            $userData = [];
            if ($request->email) {
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                ]);

                $userData =
                    [
                        'email' => $request->email,
                        'name' => $request->name,
                        'password' => Hash::make($request->password),
                        'role' => $role,
                    ];
                $user = User::create($userData);
                Host::create([
                    'name' => $user->name,
                    'user_id' => $user->id,
                ]);

                $subject = "Welcome to Ikoro";
                $message = "Hello " . $user->name . ",\n\nThank you for registering with us. Your account is now active.\n\nBest regards,\nIkoro Team";
                $headers = "From: support@ikoro.ng";

                // mail($user->email, $subject, $message, $headers);
                $user->sendEmailVerificationNotification();
            }

            if ($request->phone) {
                $otp = rand(00000, 9999);
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                    'phone' => ['required', 'regex:/^\+?[1-9]\d{0,14}(\s\d{1,14})*$/'],
                    // 'phone' => ['required', 'regex:/^\+?[1-9]\d{1,14}$/'],
                ]);
                try {
                    $userData =
                        [
                            'email' => $request->phone,
                            'name' => $request->name,
                            'password' => Hash::make($request->password),
                            'remember_token' => ($role == 'host') ? $otp : null,
                            'role' => $role,
                        ];
                    $smsService = new SmsService();
                    $smsService->sendSms($request->phone, "Your OTP is: " . $otp);
                    $user = User::create($userData);
                    session(['otp' => $otp, 'user_id' => $user->id]);
                    Host::create([
                        'name' => $user->name,
                        'phone' => $request->phone,
                        'user_id' => $user->id,
                    ]);
                    return redirect()->route('otp.verify', ['phone' => $request->phone]);
                } catch (Exception $e) {
                    return redirect()->back()->withErrors(['sms_error' => 'Unable to send SMS. ' . $request->phone]);
                }
            }
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'google_meet_id' => [
                    'nullable',
                    'url',
                    'min:5',
                    'max:75'
                ],
                'whatsapp' => [
                    'nullable',
                    'regex:/^\+?[0-9]{10,15}$/'
                ]
            ]);

            // if ($request->feedback_tool == 'Both' || $request->feedback_tool == 'WhatsApp') {
            //     $request->validate([
            //         'whatsapp' => ['required'],
            //     ]);
            // }

            // if ($request->feedback_tool == 'Both' || $request->feedback_tool == 'Skype') {
            //     $request->validate([
            //         'skype' => ['required'],
            //     ]);
            // }
            $userData =
                [
                    'email' => $request->email,
                    'name' => $request->name,
                    'password' => Hash::make($request->password),
                    'role' => $role,
                ];
            $user = User::create($userData);
            Client::create([
                'name' => $request->name,
                'user_id' => $user->id,
                'feedback_tool' => $request->feedback_tool,
                'whatsapp' => $request->whatsapp,
                'google_meet_id' => $request->google_meet_id
                // 'skype' => $request->skype
            ]);

            $subject = "Welcome to Ikoro";
            $message = "Hello " . $user->name . ",\n\nThank you for registering with us. Your account is now active.\n\nBest regards,\nIkoro Team";
            $headers = "From: support@ikoro.ng";

            // mail($user->email, $subject, $message, $headers);
            $user->sendEmailVerificationNotification();
        }

        // event(new Registered($user));
        Auth::login($user);

        switch (Auth::user()->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'host':
                return redirect()->route('host.dashboard');
            case 'user':
                return redirect('/');
            default:
                abort(404);
        }
    }
}
