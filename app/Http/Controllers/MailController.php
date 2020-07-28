<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use App\Mail\PrettyEmail;
class MailController extends Controller
{
    public function send(){
        try {
            $user = User::findOrFail(3);
            // Mail::to($user)->send(new VerificationMail($user));
            Mail::to($user)->send(new PrettyEmail());
            return redirect(url('/'))->with('success',__('mail.messages.sentSuccessfully'));
        } catch (\Throwable $th) {
            return redirect(url('/'))->with('error',__('mail.messages.notFound'));
        }
    }
}
