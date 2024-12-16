<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function verifyIdentity(Request $request)
    {
        Log::info('Verify Identity Request', [
            'school_id' => $request->school_id,
            'email' => $request->email
        ]);

        $request->validate([
            'school_id' => 'required|string',
            'email' => 'required|email'
        ]);

        $user = User::where('school_id', $request->school_id)
                    ->where('email', $request->email)
                    ->first();

        Log::info('User found?', ['user_exists' => (bool)$user]);

        if (!$user) {
            Log::info('User not found, returning with errors');
            return redirect()->route('password.request')
                ->withErrors([
                    'verification' => 'The provided School ID and email do not match our records.'
                ])
                ->withInput();
        }

        // Generate a unique token
        $token = Str::random(60);
        
        // Store the token in the password_reset_tokens table
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        // Store the token in the session for the next request
        session(['reset_token' => $token, 'reset_email' => $user->email]);

        return redirect()->route('password.reset.form')
            ->with('notification', [
                'message' => 'Identity verified successfully! Create now your new password.',
                'type' => 'success'
            ]);
    }

    public function showResetForm()
    {
        if (!session('reset_token') || !session('reset_email')) {
            return redirect()->route('login')
                ->withErrors(['verification' => 'Password reset session has expired. Please try again.']);
        }

        return view('auth.reset-password');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        if (!session('reset_token') || !session('reset_email')) {
            return redirect()->route('login')
                ->withErrors(['verification' => 'Password reset session has expired. Please try again.']);
        }

        $user = User::where('email', session('reset_email'))->first();

        if (!$user) {
            return redirect()->route('login')
                ->withErrors(['verification' => 'Unable to find user.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Remove the reset token
        \DB::table('password_reset_tokens')->where('email', $user->email)->delete();
        
        // Clear the session
        session()->forget(['reset_token', 'reset_email']);

        Log::info('Password changed notification set');
        return redirect()->route('login')
            ->with('notification', [
                'message' => 'Password successfully changed. You can now log in with your new password.',
                'type' => 'success'
            ]);
    }
}
