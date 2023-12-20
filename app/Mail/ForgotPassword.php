<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    public $name;

    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$name,$password)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        return $this->from('info@quickl.ai',env('APP_NAME'))->markdown('emails.forgot-password');
    }
}
