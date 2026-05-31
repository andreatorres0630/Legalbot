<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'apellido', 
        'email',
        'password_hash',
        'rol',
        'telefono',
        'departamento',
        'municipio',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

 
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Esto le dice a Laravel: "Usa password_hash para validar la clave"
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
        
    }
   
    public function expedientes()
    {
        return $this->hasMany(Expediente::class, 'usuario_id', 'id');
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'usuario_id', 'id');
    }
}