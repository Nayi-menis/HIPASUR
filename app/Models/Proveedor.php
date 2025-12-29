<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    // ESTA LÍNEA ES VITAL: indica el nombre exacto de tu tabla
    protected $table = 'proveedores';

    protected $fillable = [
        'ruc', 'razon_social', 'banco', 'nro_cuenta', 'tipo_cuenta', 'contacto_nombre', 'celular'
    ];
}