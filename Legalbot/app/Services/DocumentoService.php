<?php

namespace App\Services;

use App\Models\User;
use App\Models\PlantillaDocumento;

class DocumentoService
{
    public function generarCarta($userId,$plantillaId,$datos)
{
    $usuario = User::findOrFail($userId);

    $plantilla = PlantillaDocumento::findOrFail($plantillaId);

    $contenido = $plantilla->contenido;

    $reemplazos = [
        '{nombre_completo}' =>
            $usuario->nombre.' '.$usuario->apellido,

        '{email}' =>
            $usuario->email,

        '{telefono}' =>
            $usuario->telefono,

        '{departamento}' =>
            $usuario->departamento,

        '{municipio}' =>
            $usuario->municipio,

        '{empresa}' =>
            $datos['empresa'],

        '{descripcion_reclamo}' =>
            $datos['descripcion_reclamo'],

        '{fecha}' =>
            now()->format('d/m/Y'),
    ];

    return str_replace(
        array_keys($reemplazos),
        array_values($reemplazos),
        $contenido
    );
}
}