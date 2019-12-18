<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;

class EmailClass extends ShouldQueue
{

    protected $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( )
    {
        $this->email=$email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build($view='Default')
    {
        return $this->send($view);
    }

}
