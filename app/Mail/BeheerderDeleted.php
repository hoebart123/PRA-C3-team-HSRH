<?php

namespace App\Mail;

use App\Models\Beheerder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BeheerderDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $beheerder;

    public function __construct(Beheerder $beheerder)
    {
        $this->beheerder = $beheerder;
    }

    public function build()
    {
        return $this->subject('Beheerder verwijderd')
                    ->view('emails.beheerder_deleted');
    }
}