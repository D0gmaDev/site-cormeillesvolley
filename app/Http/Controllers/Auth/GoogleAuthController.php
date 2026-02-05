<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')
            ->with(['hd' => 'cormeillesvolley95.fr'])
            ->redirect();
    }

    public function callback(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();

        $email = $googleUser->getEmail();

        if (! str_ends_with($email, '@cormeillesvolley95.fr')) {
            return redirect()->route('admin.login')
                ->with('error', 'Vous devez utiliser un compte Google Workspace cormeillesvolley95.fr.');
        }

        $name = trim($googleUser->getName() ?? '');

        $user = User::firstOrCreate(
            ['email' => $email],
            ['name' => $name],
        );

        $user->update([
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
        ]);

        Auth::login($user, remember: true);

        return redirect()->route('admin.dashboard');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home');
    }
}
