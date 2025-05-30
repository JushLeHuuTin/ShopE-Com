<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    public $cartItems;

    public function __construct($invoice, $cartItems)
    {
        $this->invoice = $invoice;
        $this->cartItems = $cartItems;
    }

    public function build()
    {
        return $this->subject('Xác nhận đơn hàng từ Tên Shop')
                    ->view('emails.order_confirmation');
    }
}
