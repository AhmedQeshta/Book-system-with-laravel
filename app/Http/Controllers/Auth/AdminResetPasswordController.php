<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Providers\RouteServiceProvider;
use Password;
use Auth;

class AdminResetPasswordController extends Controller
{
    use ResetsPasswords;

     /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest:library');
      $this->middleware('guest:admin');
    }


    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected function broker()
    {
        return Password::broker('admins');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset-admin')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
