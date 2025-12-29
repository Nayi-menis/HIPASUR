<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable = ['almacen_id', 'user_id', 'trabajador', 'cantidad', 'tipo', 'motivo'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function almacen() {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }
}