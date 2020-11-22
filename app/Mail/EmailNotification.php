<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailNotification extends Mailable
{
    public $notification_details;

    public function __construct($notification_details)
    {
        $this->notification_details = $notification_details;
    }

    public function build()
    {
        return $this->subject($this->notification_details['subject'])->markdown('mail.email-notification');
    }
    
}
