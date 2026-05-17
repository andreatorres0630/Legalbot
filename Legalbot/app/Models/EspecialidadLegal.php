<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspecialidadLegal extends Model
{
    use HasFactory;

    protected $table = 'especialidad_legal';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function abogados()
    {
        return $this->hasMany(Abogado::class, 'especialidad_id');
    }
}
