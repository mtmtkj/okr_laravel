<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        AuthenticatesUsers::guard as guardForUser;
        AuthenticatesUsers::sendLoginResponse as sendLoginResponseForUser;
        AuthenticatesUsers::logout as logoutUser;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function guard($name = '')
    {
        if ($name === '') {
            return $this->guardForUser();
        }

        return Auth::guard($name);
    }

    protected function sendLoginResponse(Request $request)
    {
        $response = $this->sendLoginResponseForUser($request);
        $credentials = $this->credentials($request);
        $auth = $this->guard('admin');
        if ($auth->attempt($credentials, $request->has('remember'))) {
            return $this->authenticated($request, $this->guard('admin')->user())
                ?: redirect()->intended($this->redirectPath());
        }

        return $response;
    }

    public function logout(Request $request)
    {
        $response = $this->logoutUser($request);
        $this->guard('admin')->logout();

        return $response;
    }
}
