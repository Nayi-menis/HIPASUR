<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    protected $fillable = [
        'user_id',
        'nombres', 
        'apellidos', 
        'DNI', 
        'celular', 
        'fecha_nacimiento'
    ];

    // Relación para que la ficha sepa quién es su usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
