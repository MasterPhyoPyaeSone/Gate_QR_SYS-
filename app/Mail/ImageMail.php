<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ImageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $messageText;
    public $imagePath;
    public $imageName;

    public function __construct($subject, $messageText, $imagePath, $imageName)
    {
        $this->subject = $subject;
        $this->messageText = $messageText;
        $this->imagePath = $imagePath;
        $this->imageName = $imageName;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.imagemail') // Create a view for the email
                    ->with(['messageText' => $this->messageText])
                    ->attach($this->imagePath, [
                        'as' => $this->imageName,
                        'mime' => 'image/jpeg', // Adjust based on the image type
                    ]);
    }
}

