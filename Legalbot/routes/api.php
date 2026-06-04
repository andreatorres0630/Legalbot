<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LegalChatController;
use App\Http\Controllers\DocumentoController;


// Asegúrate de que la ruta NO esté metida dentro de ningún Route::middleware('auth:sanctum')
Route::middleware('auth')->post('/chat/consulta', [LegalChatController::class, 'procesarConsulta']);
// routes/api.php
Route::get('/maps-config', function () {
    return response()->json([
        'key' => config('services.google_maps.key')
    ]);
});
