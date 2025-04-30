<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $orders;
    public $totalAmount;

    public function __construct($orders)
    {
        $this->orders = $orders;
        $this->totalAmount = $orders->sum('total_amount');
    }

    public function build()
    {
        return $this->subject('Confirmation de commande - MAJĀA')
            ->view('emails.order-confirmation');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle commande' ,
            from: 'majaacouture7@gmail.com',
            replyTo: ['majaacouture7@gmail.com'],
        );
    }


}
