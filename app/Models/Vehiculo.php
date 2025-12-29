<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si es el plural del modelo, pero bueno para asegurar)
    protected $table = 'vehiculos';

    // Estos son los campos que permitimos llenar masivamente desde el formulario
    protected $fillable = [
        'codigo_interno',
        'tipo',
        'marca',
        'modelo',
        'placa',
        'horometro_actual',
        'estado',
        'observaciones'
    ];
    
}