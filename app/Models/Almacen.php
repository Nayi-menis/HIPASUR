<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    protected $table = 'almacens'; // Forzamos el nombre de la tabla

    protected $fillable = [
        'codigo', 
        'nombre', 
        'descripcion', 
        'stock', 
        'stock_minimo', 
        'precio_unitario', 
        'categoria', 
        'unidad_medida'
    ];
}