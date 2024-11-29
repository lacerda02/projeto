<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class TwoFactorCodeMail extends Mailable
{
    public $verificationCode;

    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

    public function build()
    {
        return $this->view('emails.two_factor_code')
                    ->subject('Seu Código de Verificação');
    }
}
