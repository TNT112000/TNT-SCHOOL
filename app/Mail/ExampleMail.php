<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExampleMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $subject = 'Subject of the email';
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function Send_user()
    {
        return $this->view('admin.pages.email.users', ['data' => $this->data]);
    }

   
     
}
