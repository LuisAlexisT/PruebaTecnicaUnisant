<?php

namespace App\Services;

use App\Models\Alumno;
use Illuminate\Support\Facades\Mail;

class AlumnoServices
{
    /**
     * Genera una matrícula única para un nuevo alumno.
     *
     * @return string
     */
    public function generarMatricula()
    {
        $ultimoAlumno = Alumno::orderBy('created_at', 'desc')->first();
        $ultimoNumero = $ultimoAlumno ? (int) substr($ultimoAlumno->matricula, -4) : 0;
        $nuevoNumero = str_pad($ultimoNumero + 1, 4, '0', STR_PAD_LEFT);
        return 'ALU-' . date('Y') . '-' . $nuevoNumero;
    }

    /**
     * Envía un correo de bienvenida al alumno.
     *
     * @param Alumno $alumno
     */
    public function enviarCorreoBienvenida(Alumno $alumno)
    {
        Mail::to($alumno->correo_electronico)->send(new \App\Mail\BienvenidaAlumno($alumno));
    }
}