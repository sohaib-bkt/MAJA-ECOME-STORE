<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Collection;

class OrderBusinessNotification extends Mailable
{

    use Queueable, SerializesModels;

    public $orders;
    public $totalAmount;

    public function __construct(Collection $orders)
    {
        $this->orders = $orders->loadMissing('product');
        $this->totalAmount = $orders->sum('total_amount');
    }

    public function build()
    {
        return $this->subject('Nouvelle commande reçue - #' . $this->orders->first()->id)
                    ->view('emails.order-maja')
                    ->with([
                        'orders' => $this->orders,
                        'totalAmount' => $this->totalAmount
                    ]);
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