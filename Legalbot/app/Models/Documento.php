<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documento';

    public $timestamps = false;

    protected $fillable = [
        'consulta_id',
        'usuario_id',
        'plantilla_id',
        'titulo',
        'contenido',
        'archivo_url',
        'estado'
    ];


    public function usuario()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function plantilla()
    {
        return $this->belongsTo(PlantillaDocumento::class,'plantilla_id');
    }

    public function consulta()
    {
        return $this->belongsTo(Consulta::class,'consulta_id');
    }
}