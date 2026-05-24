<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL; // <-- Importante

class InvitacionColaborador extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $correoInvitado;

    public function __construct($correoInvitado)
    {
        $this->correoInvitado = $correoInvitado;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitación a Colaborar en Noteworld API',
        );
    }

    public function content(): Content
    {
        // Generamos la ruta firmada segura
        $urlSegura = URL::signedRoute('colaborar');

        return new Content(
            markdown: 'emails.invitacion', // O 'view' si no usas markdown
            with: [
                'urlSegura' => $urlSegura,
            ],
        );
    }
}