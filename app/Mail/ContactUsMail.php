<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('E-Commerce Contact Us')
                    ->view('emails.contact_us') // dùng view HTML thuần
                    ->with([
                        'user' => $this->user,
                    ]);
    }
}
