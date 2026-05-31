<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReglaLegal extends Model
{
    use HasFactory;

    // Forzamos a Laravel a conectarse a tu tabla existente
    protected $table = 'regla_legal';

    // Definimos los campos reales de tu captura
    protected $fillable = [
        'categoria_id',
        'titulo',
        'descripcion',
        'ley_referencia',
        'articulo',
        'vigente'
    ];
}