<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    // Esto es vital para que el método store() funcione
    protected $fillable = [
        'codigo', 'nombre', 'descripcion', 'stock', 
        'stock_minimo', 'precio_unitario', 'categoria', 'unidad_medida'
    ];
}