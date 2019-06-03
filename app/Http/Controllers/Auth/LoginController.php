<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    //
    protected $username = 'userid';
    use AuthenticatesUsers;







    /*
        protected function credentials(Request $request)
        {
            return $request->only($this->userid(), 'password');
            $credentials = array_add($credentials, 'approved', '1');
            return $credentials;
        }
    */
    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    // protected $userid = 'userid';






    /**
     * Validate the user login.
     * @param Request $request
     */


    // protected $redirectTo = '/home';



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function username()
    {
        return 'userid';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }


}
