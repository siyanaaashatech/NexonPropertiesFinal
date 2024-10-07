<?php

namespace App\Http\Controllers\Auth;

use App\Models\History;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\UtilityFunctions;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($user = \App\Models\User::where($this->username(), $request->{$this->username()})->first()) {
            if (is_null($user->email_verified_at)) {
                $errors = [$this->username() => 'Your email is not verified. Please verify your email to continue.'];
            }
        }

        throw ValidationException::withMessages($errors);
    }

    protected function authenticated(Request $request, $user)
    {
        if (is_null($user->email_verified_at)) {
            Auth::guard('web')->logout();
            Auth::guard('admin')->logout();
            return redirect()->route('login')->withErrors(['email' => 'Please verify your email before logging in.']);
        }

        History::create([
            'description' => 'Logged in',
            'user_id' => $user->id,
            'type' => 0,
            'ip_address' => UtilityFunctions::getuserIP()
        ]);

        if ($user->role_id == 3) {
            Auth::guard('web')->login($user);
            return redirect()->route('index');
        } else {
            Auth::guard('admin')->login($user);
            return redirect()->route('admin.index');
        }
    }

    public function logout(Request $request)
    {
        $this->logoutUser('web');
        $this->logoutUser('admin');

        return redirect('/login')->with('status', 'Successfully logged out.');
    }

    protected function logoutUser($guard)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();
            History::create([
                'description' => 'Logged out',
                'user_id' => $user->id,
                'type' => 0,
                'ip_address' => UtilityFunctions::getuserIP()
            ]);
            Auth::guard($guard)->logout();
        }
    }
}