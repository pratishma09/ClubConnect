<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;
    public $email;

    public function __construct($email, $code)
    {
        $this->email = $email;
        $this->code = $code;
    }

    public function build()
    {
        return $this->view('emails.verification_code')
                    ->with([
                        'email' => $this->email,
                        'code' => $this->code,
                        'verificationUrl' => route('users.verify', ['email' => $this->email, 'code' => $this->code]),
                    ]);
    }
}


?>
