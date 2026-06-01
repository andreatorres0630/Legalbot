<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantillaDocumento extends Model
{
    protected $table = 'plantilla_documento';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'contenido',
        'categoria_id',
        'activa'
    ];

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'plantilla_id');
    }
}