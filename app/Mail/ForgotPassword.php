<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $full_name;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($full_name, $token)
    {
        $this->full_name = $full_name;
        $this->url = $host = request()->getHttpHost() . '/auth/reset/password/' . $token;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.forgot-password');
    }
}
