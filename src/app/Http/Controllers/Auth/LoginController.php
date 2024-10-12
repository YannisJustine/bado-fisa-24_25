<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Support\Str;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }

    /**
     * Show login view
     */
    public function index() {  

        return view("auth.login");
    }
    
    /**
     * Attempt login connection
     * @return RedirectResponse
     */
    public function authenticate(LoginRequest $request) {
        try {
            $this->checkTooManyFailedAttempts();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()])->withInput($request->input());
        }

        RateLimiter::hit($this->throttleKey(), $seconds = config('auth.retries_timeout'));
        $retriesLeft = RateLimiter::retriesLeft($this->throttleKey(), config('auth.max_attempts'));

        $credentials = $request->validated();
        if (!Auth::attempt(['num_securite_sociale' => $credentials['num_secu'], 'password' => $credentials['password']], $request->filled('remember'))) {
            $errors = ['error' => "Impossible de se connecter", 'retriesLeft' => __('auth.retries', ['retriesLeft' => $retriesLeft])];
            return redirect()->back()->withErrors($errors)->withInput($request->input());
        }

        RateLimiter::clear($this->throttleKey());

        return redirect()->intended();
    }

    /**
     * Get data to be passed to the view 
     * @return array
     */
    private function getDataLoginView() {
        $data = [];
        $data['routePost'] =  route('login.ldap.post');

        return $data;
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower(request('login')) . '|' . request()->ip();
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     */
    public function checkTooManyFailedAttempts()
    {
        if (RateLimiter::retriesLeft($this->throttleKey(), config('auth.max_attempts')) > 0) {
            return;
        }
        $seconds = RateLimiter::availableIn($this->throttleKey());
        $minutes = ceil($seconds / 60);
        throw new Exception(__('auth.throttle', ['minutes' => $minutes]));
    }

}
