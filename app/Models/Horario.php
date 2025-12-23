<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'horarios';

    // Campos que permitimos llenar masivamente
    protected $fillable = [
        'recurso_id',
        'fecha',
        'hora_entrada',
        'hora_salida',
        'turno',
        'observaciones'
    ];

    /**
     * Relación: Un horario pertenece a un Recurso (Trabajador)
     * Esto permite hacer $horario->recurso->nombres
     */
    public function recurso()
    {
        return $this->belongsTo(Recurso::class, 'recurso_id');
    }

    public function obtenerEstado()
    {
        if (!$this->hora_salida) return 'EN PROCESO';
        $entrada = \Carbon\Carbon::parse($this->hora_entrada);
        $salida = \Carbon\Carbon::parse($this->hora_salida);
        $horas = $entrada->diffInHours($salida);

        if ($horas >= 8) return 'COMPLETO';
        return 'INCOMPLETO';
    }
}