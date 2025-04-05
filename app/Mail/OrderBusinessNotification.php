<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use Illuminate\Mail\Mailables\Envelope;

class OrderBusinessNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Nouvelle commande reçue - #' . $this->order->id)
                    ->view('emails.order-maja');
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle commande' ,
            from: 'majaacouture7@gmail.com',
            replyTo: ['majaacouture7@gmail.com'],
        );
    }
}