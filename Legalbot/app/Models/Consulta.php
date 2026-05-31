<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    // Esto le dice a Laravel el nombre exacto de tu tabla en MySQL
    protected $table = 'consulta'; 

    // Permite que se puedan guardar datos masivamente desde el controlador
    protected $guarded = []; 
}