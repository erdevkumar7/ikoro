<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HostMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            logger()->info('User Role: ' . $user->role);
            if ($user->host) {
                $hostStatus = (int) $user->host->status;
                logger()->info('Host Status: ' . $hostStatus);
            } else {
                logger()->info('No host relationship found.');
                $hostStatus = null;
            }

            if ($user->role === 'host' && $hostStatus === 1) {
                logger()->info('All conditions met, continuing the request.');
                return $next($request);
            }
        }

        logger()->info('Redirecting user to login due to failed condition.');

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->withErrors(['status' => 'Your account is inactive. Please contact support.']);
    }
}
