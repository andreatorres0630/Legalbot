<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('DashboardAdmin');
});

Route::get('/usuarios', function () {
    return view('GestionUsuarios');
});

Route::get('/abogados', function () {return view('abogados'); 
});

Route::get('/registro', function () {return view('registro');
});

Route::get('/inicio', function () {return view('Dashboard'); 
});