<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $table = 'expediente';
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'numero',
        'estado',
        'descripcion',
        'apertura',
        'cierre',
    ];

    protected $casts = [
        'apertura' => 'datetime',
        'cierre'   => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'expediente_id', 'id');
    }
}