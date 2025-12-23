<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    protected $fillable = ['fecha', 'zona', 'cantidad', 'tipo_mineral', 'recurso_id', 'observaciones'];

    public function recurso() {
        return $this->belongsTo(Recurso::class, 'recurso_id');
    }
    // Esto permite que la vista 'control' funcione y no salga el error de la foto 1
    public function horarios()
    {
        return $this->hasMany(Horario::class, 'recurso_id');
    }

    // Esto permitirá que también puedas ver la producción de cada trabajador
    public function producciones()
    {
        return $this->hasMany(Produccion::class, 'recurso_id');
    }
}