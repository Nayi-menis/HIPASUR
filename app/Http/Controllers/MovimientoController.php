<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almacen;
use App\Models\Movimiento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MovimientoController extends Controller
{
    
   public function store(Request $request)
    {
        // 1. Buscamos el producto
        $producto = \App\Models\Almacen::findOrFail($request->almacen_id);

        // 2. VALIDACIÓN: Si es SALIDA, verificamos disponibilidad
        if ($request->tipo == 'SALIDA') {
            if ($request->cantidad > $producto->stock) {
                // Regresamos a la vista con el mensaje de error específico
                return back()->withErrors([
                    'cantidad' => "Stock insuficiente. Solo quedan {$producto->stock} unidades de {$producto->nombre}."
                ])->withInput();
            }
        }

        // 3. Si todo está bien, grabamos
        \DB::transaction(function () use ($request, $producto) {
            \App\Models\Movimiento::create([
                'almacen_id' => $request->almacen_id,
                'user_id'    => auth()->id(),
                'trabajador' => $request->trabajador,
                'cantidad'   => $request->cantidad,
                'tipo'       => $request->tipo,
                'motivo'     => $request->motivo ?? 'Sin motivo',
            ]);

            if ($request->tipo == 'SALIDA') {
                $producto->decrement('stock', $request->cantidad);
            } else {
                $producto->increment('stock', $request->cantidad);
            }
        });

        return back()->with('mensaje', 'Movimiento registrado correctamente')->with('icono', 'success');
    }
}