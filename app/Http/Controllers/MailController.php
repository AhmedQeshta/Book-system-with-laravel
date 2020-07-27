<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
class MailController extends Controller
{
    public function send(){
        try {
            // $admin = Admin::findOrFail(1);
            $user = User::findOrFail(3);
            // dd($user->email);
            Mail::to($user)->send(new VerificationMail($user));
            // Mail::to($admin)->send(new VerificationMail($admin));
            return redirect(url('/'))->with('success',__('mail.messages.sentSuccessfully'));
        } catch (\Throwable $th) {
            return redirect(url('/'))->with('error',__('mail.messages.notFound'));
        }
    }
}
