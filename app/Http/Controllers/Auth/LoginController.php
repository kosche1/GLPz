<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'], // This can be either school_id or email
            'password' => ['required'],
        ]);

        // Check if input is an email
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'school_id';

        // Find the user
        $user = User::where($loginType, $request->login)->first();

        if (!$user) {
            $errorMessage = $loginType === 'email' ? 'Email not found.' : 'School ID not found.';
            return back()->withErrors([
                'login' => $errorMessage,
            ])->withInput($request->except('password'));
        }

        // Attempt authentication
        $authCredentials = [
            $loginType => $request->login,
            'password' => $request->password
        ];

        if (Auth::attempt($authCredentials)) {
            $request->session()->regenerate();

            // Redirect based on user role
            switch ($user->role) {
                case 'superadmin':
                    return redirect()->route('superadmin.dashboard');
                case 'admin':
                    return redirect()->route('admin.dashboard');
                default:
                    return redirect()->route('dashboard');
            }
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }
}
