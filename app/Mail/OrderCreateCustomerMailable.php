<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreateCustomerMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $$this->;
     */
    public function build()
    {
        return $this->subject('Narudžbina uspešno kreirana')
            ->to($this->data['email'])
            ->from('sales@hemingwayleather.com')
            ->view('mails.order-create-customer', $this->data);
    }
}
