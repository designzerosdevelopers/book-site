<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found.'])->withInput();
        }

        // Find the password reset record by email
        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        // Check if the token is valid and not expired
        if ($record && Hash::check($request->token, $record->token) && !$this->tokenExpired($record->created_at)) {
            // Token is valid, reset the password
            $user->password = bcrypt($request->password);
            $user->save();

            // Remove the password reset record
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            return redirect()->route('login')->with('status', 'Password has been reset!');
        } else {
            return back()->withErrors(['token' => 'Invalid or expired token.'])->withInput();
        }
    }

    // Helper function to check if the token has expired
    protected function tokenExpired($createdAt)
    {
        $expiration = config('auth.passwords.users.expire', 60); // Default expiration time is 60 minutes
        return Carbon::parse($createdAt)->addMinutes($expiration)->isPast();
    }
}
