<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function authenticated()
    {

        // dd(Auth::user()->status =='active');
        if (Auth::User()->status =='inactive') {
            Auth::logout();
            // return redirect()->back()->withErrors('error' => 'Account not activate, please try again later or contact support.')->withInput();
            return back()->with('error', 'Your Account is Not Activated !...');
        }

     }
    //  protected function credentials(Request $request)
    // {
    //     return ['email'=>$request->{$this->username()},'password'=>$request->password,'status'=>"T"];
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }
}
