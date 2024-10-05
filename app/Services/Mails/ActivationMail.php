<?php

namespace App\Services\Mails;

use App\Models\UserReservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private readonly UserReservation $userReservation)
    {
    }

    public function build()
    {
        return $this->subject(__('mail.activation.subject', ['servername' => env('SERVER_NAME')]))
            ->view('MailTemplates.welcome')
            ->with([
                'username' => $this->userReservation->username,
                'activationCode' => $this->userReservation->act,
                'link' => route('activationPage', ['code' => $this->userReservation->act])
            ]);
    }
}
