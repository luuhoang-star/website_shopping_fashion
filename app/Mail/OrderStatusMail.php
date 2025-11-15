<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('E-Commerce Order Status')
                    ->view('emails.order_status') // dùng view HTML thuần
                    ->with([
                        'order' => $this->order,
                    ]);
    }
}
