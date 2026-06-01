<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AbogadoController;
use App\Http\Controllers\Api\ExpedienteController;
use App\Http\Controllers\API\LegalChatController;
use App\Http\Controllers\DocumentoController;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('DashboardAdmin');
})->middleware('auth');

Route::get('/usuarios', function () {
    return view('GestionUsuarios');
})->middleware('auth');

Route::get('/abogados', function () {
    return view('abogados');
})->middleware('auth');

Route::get('/registro', function () {
    return view('registro');
})->middleware('guest');

Route::get('/inicio', function () {
    return view('Dashboard');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/usuarios/list', [UsuarioController::class, 'index']);
    Route::post('/usuarios', [UsuarioController::class, 'store']);
    Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update']);
    Route::delete('/usuarios/{usuario}', [UsuarioController::class, 'destroy']);

    Route::get('/abogados/list', [AbogadoController::class, 'index']);
    Route::post('/abogados', [AbogadoController::class, 'store']);
    Route::put('/abogados/{abogado}', [AbogadoController::class, 'update']);
    Route::delete('/abogados/{abogado}', [AbogadoController::class, 'destroy']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::get('/actividad-reciente', [AuthController::class, 'actividadReciente']);
    Route::get('/mis-expedientes', fn() => view('MisExpediente'));
    Route::get('/expedientes/{numero}', fn() => view('DetalleExpediente'));
    Route::get('/api/expedientes',                    [ExpedienteController::class, 'index']);
    Route::post('/api/expedientes',                   [ExpedienteController::class, 'store']);
    Route::get('/api/expedientes/{numero}',           [ExpedienteController::class, 'show']);
    Route::patch('/api/expedientes/{numero}/estado',  [ExpedienteController::class, 'updateEstado']);
    Route::get('/api/expedientes/{numero}/historial', [ExpedienteController::class, 'historial']);
    Route::get('/api/mis-consultas',                  [ExpedienteController::class, 'misConsultas']);

    Route::post('/api/chat/consulta', [LegalChatController::class, 'procesarConsulta']);
    Route::delete('/api/expedientes/{numero}',        [ExpedienteController::class, 'destroy']);

});

Route::get('/chatLegal', function () {
    return view('ChatLegal');
})->middleware('auth');

Route::get('/documentos', function() {return view('documentos');});

// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/api/documentos', [DocumentoController::class, 'index']);
    Route::post('/api/documentos/generar-acuerdo', [DocumentoController::class, 'generarAcuerdo']);
    Route::post('/api/documentos/generar-reclamo',  [DocumentoController::class, 'generarReclamo']);
    Route::post('/api/documentos/generar-denuncia', [DocumentoController::class, 'generarDenuncia']);
    Route::post('/api/documentos/borrador',          [DocumentoController::class, 'guardarBorrador']);
});

// routes/api.php
