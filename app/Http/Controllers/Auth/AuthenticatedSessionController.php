<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Jenssegers\Agent\Agent;

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
//    public function store(LoginRequest $request): RedirectResponse
//    {
//        $request->authenticate();
//        $request->session()->regenerate();
//        return redirect()->intended(RouteServiceProvider::HOME);
//    }

    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();
        // Regenerate session
        $request->session()->regenerate();
        // Get user information
        $user = Auth::user();
        // Store login time and other information
        $userAgent = new Agent();
        $data = [
            'email' => $user->email,
            'ip' => $request->ip(),
            'browser' => $userAgent->browser(),
            'platform' => $userAgent->platform(),
            'last_login' => now(), // or use your preferred date format
            'user_agent' => $request->header('User-Agent'),
        ];
        // Save the data to the database
        DB::table('login_logs')->insert($data);
        // Redirect the user to the intended page
        return redirect()->intended(RouteServiceProvider::HOME);
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
