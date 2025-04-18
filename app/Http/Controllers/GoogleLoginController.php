<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {


        $googleUser = Socialite::driver('google')->user();



        // Check if the user already exists in the database
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {

            // If the user doesn't exist, create a new one
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'is_registration_by' => 'User',
                'status' => 1,
                'email_verified_at' => now(),
            ]);
        }

        // Assign role based on is_registration_by value
        $role = match ($user->is_registration_by) {
            'User' => 'User',
        };
        $user->assignRole($role);

        Auth::login($user, true);

        return redirect()->to('/'); // Redirect after successful login
    }
}
