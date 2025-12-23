<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'vehiculos';

    /**
     * Los atributos que se pueden asignar masivamente (Fillable).
     * Esto evita el error de "MassAssignmentException" al guardar.
     */
    protected $fillable = [
        'codigo_interno', // Ej: EXCA-001, VOL-02
        'tipo',           // Excavadora, Camioneta, Volquete
        'placa',          // Opcional para maquinaria pesada
        'marca',
        'modelo',
        'serie_motor',    // Importante para mantenimiento
        'estado',         // OPERATIVO, EN TALLER, FUERA DE SERVICIO
        'descripcion'     // Detalles adicionales
    ];

    /**
     * Si deseas que Laravel gestione automáticamente las fechas 
     * de creación y actualización (ya viene por defecto, pero es bueno saberlo)
     */
    public $timestamps = true;
}