<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\BienvenidaAlumno;
use App\Services\AlumnoServices;

class AlumnoController extends Controller
{
    protected $alumnoServices;

    public function __construct(AlumnoServices $alumnoServices)
    {
        $this->alumnoServices = $alumnoServices;
    }

    // Listar alumnos
    public function index()
    {
        $alumnos = Alumno::with('sede')->orderBy('created_at', 'desc')->get();
        return response()->json($alumnos);
    }

    // Guardar alumno con generación matrícula y envío de correo
    public function store(Request $request)
    {
        // Validaciones
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'apellido_materno' => 'nullable|string',
            'correo_electronico' => 'required|email|unique:alumnos,correo_electronico',
            'sede_id' => 'required|exists:sedes,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Generar matrícula
        $matricula = $this->alumnoServices->generarMatricula();
        if (!$matricula) {
            return response()->json(['error' => 'No se pudo generar la matrícula'], 500);
        }

        // Crear alumno
        $alumno = Alumno::create([
            'matricula' => $matricula,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'apellido_materno' => $request->apellido_materno,
            'correo_electronico' => $request->correo_electronico,
            'sede_id' => $request->sede_id,
        ]);

        if (!$alumno) {
            return response()->json(['error' => 'No se pudo crear el alumno'], 500);
        }

        // Enviar correo de bienvenida
        $this->alumnoServices->enviarCorreoBienvenida($alumno);
        // Retornar respuesta
        
        return response()->json($alumno, 201);
    }

    // Consultar alumno por matrícula
    public function show($matricula)
    {
        $alumno = Alumno::with('sede')->where('matricula', $matricula)->first();

        if (!$alumno) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }

        return response()->json($alumno);
    }

    // Función para generar matrícula automática
    
}
