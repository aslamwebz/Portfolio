<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = $request->user();
        if (! $user) {
            abort(401, 'Unauthorized');
        }

        $passwordInput = $request->input('password');
        $password = is_string($passwordInput) ? $passwordInput : '';

        $user->update([
            'password' => Hash::make((string) $password),
        ]);

        return back();
    }
}
