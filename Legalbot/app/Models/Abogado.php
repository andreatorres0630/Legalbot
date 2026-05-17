<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abogado extends Model
{
    use HasFactory;

    protected $table = 'abogado';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'especialidad_id',
        'telefono',
        'whatsapp',
        'email',
        'direccion',
        'disponible',
        'verificado',
    ];

    public function especialidadLegal()
    {
        return $this->belongsTo(EspecialidadLegal::class, 'especialidad_id');
    }
}
