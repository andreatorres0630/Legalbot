<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('login');
})->middleware('guest');

Route::get('/login', function () {
    return view('login');
})->middleware('guest');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('DashboardAdmin');
})->middleware('auth');

Route::get('/usuarios', function () {
    return view('GestionUsuarios');
})->middleware('auth');

Route::get('/abogados', function () {return view('abogados'); 
})->middleware('auth');

Route::get('/registro', function () {return view('registro');
})->middleware('guest');

Route::get('/inicio', function () {return view('Dashboard'); 
})->middleware('auth');