<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    // Redirect the user to the Provider's authentication page
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Handle the callback from the Provider
    public function callback(string $provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['oauth' => 'Authentication failed. Please try again.']);
        }

        // Find or create the user in your database
        $user = User::firstOrCreate(
            [
                'email' => $socialUser->getEmail(),
            ],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'provider_name' => $provider,
                'provider_id' => $socialUser->getId(),
                'password' => null, // No password for OAuth users
                'role' => 0,        // Explicitly force '0' (Member) for new registrations
            ]
        );

        // Optional: Update provider info if an existing traditional user logs in via OAuth
        if (!$user->provider_id) {
            $user->update([
                'provider_name' => $provider,
                'provider_id' => $socialUser->getId(),
            ]);
        }

        // Log the user in
        Auth::login($user);

        // Redirect based on role context within your Project Management System
        return $user->role === 1 
            ? redirect()->intended(route('admin.dashboard')) 
            : redirect()->intended(route('dashboard'));
    }
}
