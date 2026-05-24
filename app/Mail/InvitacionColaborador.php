<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvitacionColaborador extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    // Declaramos una variable pública para pasarla a la vista
    public $correoInvitado;

    public function __construct($correo)
    {
        $this->correoInvitado = $correo;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Invitación para colaborar en Noteworld!',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.invitacion',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}