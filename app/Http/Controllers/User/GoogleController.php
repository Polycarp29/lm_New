<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect to Google OAuth.
     */
    public function redirectToGoogle(Request $request)
    {
        // Store the user intent (login or register)
        session(['google_intent' => $request->query('intent', 'login')]);

        $parameters = [
            'access_type' => 'offline',
            'prompt' => 'consent'
        ];

        return Socialite::driver('google')
            ->scopes([
                'openid',
                'profile',
                'email',
                'https://www.googleapis.com/auth/documents.readonly'
            ])
            ->with($parameters)
            ->redirect();
    }

    /**
     * Handle Google callback.
     */
    public function handleGoogleCallback()
    {
        try {
            // Retrieve user from Google (with session support)
            $googleUser = Socialite::driver('google')->user();
            $intent = session('google_intent', 'login');

            // Check if user already exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Create new user and login
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                    'password' => bcrypt(Str::random(16)), // Required for non-nullable password fields
                ]);

                $user->assignRole('user');
                Auth::login($user);

                return redirect()->route('dashboard');
            }

            if (!$user && $intent === 'login') {
                return redirect()->route('login')->withErrors([
                    'email' => 'No account found. Try registering first.',
                ]);
            }

            // Update Google tokens for existing user
            $user->update([
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);

            // Log in the user
            Auth::login($user);

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'google_error' => 'Google authentication failed. Please try again.',
            ]);
        }
    }
}


