<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuestQrMail extends Mailable
{
    use Queueable, SerializesModels;

    public $qrPath;

    public function __construct($qrPath)
    {
        $this->qrPath = $qrPath;
    }

    public function build()
    {
        return $this->subject('Your Guest QR Code')
                    ->view('emails.guest_qr')
                    ->attach($this->qrPath);
    }
}

