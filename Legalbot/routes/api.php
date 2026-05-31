<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LegalChatController;


// Asegúrate de que la ruta NO esté metida dentro de ningún Route::middleware('auth:sanctum')
Route::middleware('auth')->post('/chat/consulta', [LegalChatController::class, 'procesarConsulta']);

