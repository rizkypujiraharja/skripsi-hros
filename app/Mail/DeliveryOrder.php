<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeliveryOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $products, $date)
    {
        $this->order = $order;
        $this->products = $products;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.delivery')
                    ->with([
                        'order' => $this->order,
                        'products' => $this->products,
                        'date' => $this->date,
                    ])
                    ->subject('Pesanan '.$this->order->invoice_code.' Telah Dikirim');
    }
}
