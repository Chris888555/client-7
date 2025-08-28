<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User\Users;

class ApprovedNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(Users $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Your account has been approved')
                    ->view('emails.approved');
    }
}
