<?php

namespace App\Services;

use App\Models\Expediente;

class ExpedienteService
{
    private string $caracteres = 'ABCDEFGHJKMNPQRSTUVWXYZ23456789';

    public function generarCodigo(): string
    {
        do {
            $anio   = date('Y');
            $random = '';
            for ($i = 0; $i < 5; $i++) {
                $random .= $this->caracteres[random_int(0, strlen($this->caracteres) - 1)];
            }
            $codigo = "EXP-{$anio}-{$random}";
        } while (Expediente::where('numero', $codigo)->exists());

        return $codigo;
    }

    public function crearExpediente(int $usuarioId, string $descripcion = ''): Expediente
    {
        return Expediente::create([
            'usuario_id'  => $usuarioId,
            'numero'      => $this->generarCodigo(),
            'estado'      => 'abierto',
            'descripcion' => $descripcion,
            'apertura'    => now(),
        ]);
    }
}