<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SchoolRegistrationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // array with submitted fields

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Bevestiging inschrijving Paastoernooi')
                    ->view('emails.inschrijving_bevestiging');
    }
}