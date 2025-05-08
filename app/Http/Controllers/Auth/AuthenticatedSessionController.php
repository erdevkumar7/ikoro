<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $role = Auth::user()->role;

        // If booking data exists in session, redirect to payment page with those details
        if ($role === 'user' && session()->has('booking.gig_id')) {                 
            return redirect()->route('user.strip.payment');
        }
        // Optional: If redirect URL is passed (e.g., from query param or hidden input)
        // $redirectTo = $request->input('redirect_to');
        // if ($redirectTo && url()->previous() == $redirectTo) {
        //     return redirect($redirectTo); // Redirect to booking page if present
        // }

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'host':
                return redirect()->route('host.dashboard');
            case 'user':
                return redirect('/');
            default:
                abort(404);
        }
        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
