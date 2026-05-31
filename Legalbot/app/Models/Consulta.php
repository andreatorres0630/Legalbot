<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consulta';
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'expediente_id',
        'categoria_id',
        'abogado_recomendado_id',
        'pregunta',
        'respuesta_ia',
        'estado',
        'prioridad',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    // Una consulta tiene muchos mensajes
    public function mensajes()
    {
        return $this->hasMany(MensajeConsulta::class, 'consulta_id', 'id');
    }

    // Una consulta pertenece a un expediente
    public function expediente()
    {
        return $this->belongsTo(Expediente::class, 'expediente_id', 'id');
    }

    // Una consulta pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
}