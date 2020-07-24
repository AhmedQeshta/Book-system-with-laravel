<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;

class AdminForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest:admin');
    }


    protected function broker()
    {
        return Password::broker('admins');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email-admin');
    }
    
}
