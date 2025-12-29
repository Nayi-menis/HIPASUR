<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fiscalizacion extends Model
{
    protected $table = 'fiscalizaciones';

    protected $fillable = [
        'fecha',
        'entidad',
        'inspector',
        'motivo',
        'resultado',
        'observaciones',
        'medidas_adoptadas'
    ];
}
