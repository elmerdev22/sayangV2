<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationCheck extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details){
        $this->details = $details;
    }

    public function build(){
        $from_name  = env('APP_NAME');
        $from_email = env('MAIL_USERNAME');

        return $this->from($from_email, $from_name)
                ->replyTo($from_email, $from_name)
                ->subject('Account Verification')
                ->markdown('mail.verification-check');
    }
}
