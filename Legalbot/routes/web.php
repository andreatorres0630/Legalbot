<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AbogadoController;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');

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
});

// routes/api.php