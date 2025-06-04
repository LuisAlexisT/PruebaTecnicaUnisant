@component('mail::message')
# Bienvenido {{ $alumno->nombre }}

Tu matrícula generada es: **{{ $alumno->matricula }}**

Gracias por registrarte en nuestro sistema.

Saludos,  
{{ config('app.name') }}
@endcomponent
