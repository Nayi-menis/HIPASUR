<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'pagos';

    /**
     * Los atributos que se pueden asignar masivamente.
     * Estos deben coincidir exactamente con los nombres de las columnas en tu BD.
     */
    protected $fillable = [
        'fecha',
        'estado',      // EFECTIVO, TRANSFERENCIA, etc.
        'tipo',        // COMBUSTIBLE, REPUESTOS, etc.
        'descripcion',
        'monto',       // El sub-monto base
        'egreso',      // Valor si es salida de dinero
        'ingreso', 
        'recurso_id',    
        'proveedor_id',  
        'nro_operacion', 
        'metodo_pago'    
    ];

    /**
     * Casting de atributos.
     * Esto asegura que Laravel trate los montos como números decimales 
     * y la fecha como un objeto Carbon.
     */
    protected $casts = [
        'fecha'   => 'date',
        'monto'   => 'decimal:2',
        'egreso'  => 'decimal:2',
        'ingreso' => 'decimal:2',
    ];

    public function recurso()
    {
        return $this->belongsTo(Recurso::class, 'recurso_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

}

