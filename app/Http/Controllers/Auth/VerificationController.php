<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Log;

class VerificationController extends Controller
{
    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Handle the email verification process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $user = $request->user();

        // Check if the user has already verified their email
        if ($user->hasVerifiedEmail()) {
            Log::info('User attempted to verify an already verified email: ', ['user' => $user->email]);
            return redirect($this->redirectPath())->with('message', 'Your email is already verified.');
        }

        // Mark the email as verified and trigger the Verified event
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            Log::info('User email verified successfully: ', ['user' => $user->email]);

            // Optionally trigger any additional actions after verification
            // Example: You can notify the user or log additional details
        }

        // Redirect with a verified message
        return redirect($this->redirectPath())->with('verified', true)->with('message', 'Your email has been successfully verified.');
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        // Check if the user has already verified their email
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath())->with('message', 'Your email is already verified.');
        }

        // Resend the verification email
        $request->user()->sendEmailVerificationNotification();

        Log::info('Verification email resent: ', ['user' => $request->user()->email]);

        return back()->with('resent', true)->with('message', 'A fresh verification link has been sent to your email address.');
    }
}
