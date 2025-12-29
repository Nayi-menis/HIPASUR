<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguridadSalud extends Model
{
    use HasFactory;

    protected $table = 'seguridad_salud';

    protected $fillable = [
        'fecha',
        'tipo_registro',
        'area',
        'responsable',
        'nivel_riesgo',
        'descripcion',
        'accion_correctiva'
    ];
}