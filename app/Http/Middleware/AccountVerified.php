<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccountVerified
{

    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user && is_null($user->email_verified_at)) {
            return redirect()->route('account.verification');
        }
        return $next($request);
    }
}
