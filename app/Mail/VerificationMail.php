<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Admin;
use App\User;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $Myuser;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user){
        $this->Myuser = $user ; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.email',['Myuser'=>'user']);
    }
}
