<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels;

    protected $dynamic_data = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_info)
    {
        return $this->dynamic_data = $order_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('send_invoice', [
            'data' => $this->dynamic_data,
        ]);
    }
}
