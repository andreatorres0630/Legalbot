<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensajeConsulta extends Model
{
    protected $table = 'mensaje_consulta';
    public $timestamps = false;

    protected $fillable = [
        'consulta_id',
        'remitente',
        'mensaje',
        'enviado_en',
    ];

    protected $casts = [
        'enviado_en' => 'datetime',
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'consulta_id', 'id');
    }
}