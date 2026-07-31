<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->redirect();
    }

    public function callback()
    {
        $googleUser =
            Socialite::driver('google')->user();

        $user = User::where(
            'email',
            $googleUser->email
        )->first();

        if (!$user) {
            return redirect('/login')
                ->with(
                    'error',
                    'Silakan register terlebih dahulu.'
                );

    }

        if ($user->google_id == null) {
            $user->update([
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
            ]);
        }

        Auth::login($user);
        return redirect('/dashboard');
    }
}
