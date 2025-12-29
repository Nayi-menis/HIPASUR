<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;

    // Esto permite que los datos se guarden desde el controlador
    protected $fillable = [
        'nombres',
        'apellidos',
        'edad',
        'DNI',
        'celular',
        'fecha_nacimiento',
        'cuenta',
        'stc',
        'departamento',
        'provincia',
        'email',
        'user_id',
        'cargo', 
        'vehiculo_id'
    ];

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'recurso_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vehiculo() 
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }

}

