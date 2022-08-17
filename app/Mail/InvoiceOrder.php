<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $products)
    {
        $this->order = $order;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.order')
                    ->with([
                        'order' => $this->order,
                        'products' => $this->products,
                    ])
                    ->subject('Pesanan '.$this->order->invoice_code.' Berhasil Dibuat');
    }
}
