<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
// use Illuminate\Mail\Mailer;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailClass extends MailMessage implements ShouldQueue
{ 
    use Queueable;

    protected $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->email=$email;
        $this->from=config('settings.contact_email');

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build($view='emailTemplate.default',$data)
    {
        return $this->view('emailTemplate.default', $data)
        ->subject('test subject')
        ->from($this->from);
    }

}
