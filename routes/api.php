<?php
use App\Http\Controllers\Api\AlumnoController;
use App\Http\Controllers\Api\AuthController;

// RUTAS API DE ALUMNOS
Route::middleware('auth:api')->group(function () {
    Route::get('/alumnos', [AlumnoController::class, 'index']);
    Route::post('/alumnos', [AlumnoController::class, 'store']);
    Route::get('/alumnos/{matricula}', [AlumnoController::class, 'show']);
});

// RUTAS LOGIN
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    // Rutas protegidas aquí
});
