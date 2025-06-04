<?php

namespace App\Mail;

use App\Models\Alumno;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BienvenidaAlumno extends Mailable
{
    use Queueable, SerializesModels;

    public $alumno;

    public function __construct(Alumno $alumno)
    {
        $this->alumno = $alumno;
    }

    public function build()
    {
        return $this->subject('Bienvenido al sistema')
            ->markdown('emails.bienvenida')
            ->with(['alumno' => $this->alumno]);
    }
}
