<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Test extends Mailable
{
    use Queueable, SerializesModels;

   public $username;
    public function __construct($username)
    {
        $this->username = $username;
    }

    
    public function build()
    {
        return $this->from('contact@myblog.com', 'Contact')
        ->view('emails.test');
    }
}
