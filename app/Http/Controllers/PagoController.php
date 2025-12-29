<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Recurso;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    public function index() 
    {
        $pagos = Pago::orderBy('fecha', 'asc')->get();
        $total_ingresos = Pago::sum('ingreso');
        $total_egresos = Pago::sum('egreso');

        $ingresosMeses = array_fill(0, 12, 0);
        $egresosMeses = array_fill(0, 12, 0);

        foreach ($pagos as $pago) {
            $mesIndice = (int)date('m', strtotime($pago->fecha)) - 1;
            $ingresosMeses[$mesIndice] += (float)$pago->ingreso;
            $egresosMeses[$mesIndice] += (float)$pago->egreso;
        }

        return view('admin.pagos.index', compact('pagos', 'total_ingresos', 'total_egresos', 'ingresosMeses', 'egresosMeses'));
    }

    public function create()
    {
        // ESTO SOLUCIONA TU ERROR
        $trabajadores = Recurso::all();
        $proveedores = Proveedor::all();
        return view('admin.pagos.create', compact('trabajadores', 'proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required',
            'tipo' => 'required',
            'descripcion' => 'required',
            'monto' => 'required|numeric',
        ]);

        $pago = new Pago($request->all());

        // Lógica para asignar montos según el tipo de movimiento
        if ($request->tipo_movimiento == 'INGRESO') {
            $pago->ingreso = $request->monto;
            $pago->egreso = 0;
        } else {
            $pago->ingreso = 0;
            $pago->egreso = $request->monto;
            // Guardamos las nuevas relaciones
            $pago->recurso_id = $request->recurso_id;
            $pago->proveedor_id = $request->proveedor_id;
            $pago->nro_operacion = $request->nro_operacion;
            $pago->metodo_pago = $request->estado; // Sincroniza con el select de "Estado"
        }

        $pago->save();

        return redirect()->route('admin.pagos.index')
            ->with('mensaje', 'Registro contable guardado con éxito')
            ->with('icono', 'success');
    }

    public function edit($id)
    {
        $pago = Pago::findOrFail($id);
        return view('admin.pagos.edit', compact('pago'));
    }

    public function show($id) 
    {
        $pago = Pago::findOrFail($id);
        return view('admin.pagos.show', compact('pago'));
    }

    // 6. Actualizar registro (Asegura que el cambio de monto se refleje)
    public function update(Request $request, $id)
    {
        $pago = Pago::findOrFail($id);

        $request->validate([
            'fecha' => 'required|date',
            'estado' => 'required',
            'tipo' => 'required',
            'descripcion' => 'required',
            'monto' => 'required|numeric',
            'tipo_movimiento' => 'required'
        ]);

        // Actualizamos los datos básicos
        $pago->fill($request->all());

        // Forzamos la asignación de ingreso/egreso según la selección del usuario
        if ($request->tipo_movimiento == 'INGRESO') {
            $pago->ingreso = $request->monto;
            $pago->egreso = 0;
        } else {
            $pago->ingreso = 0;
            $pago->egreso = $request->monto;
        }

        $pago->save();

        return redirect()->route('admin.pagos.index')
            ->with('mensaje', 'Registro actualizado correctamente')
            ->with('icono', 'success');
    }

    public function destroy($id)
    {
        Pago::destroy($id);
        return redirect()->route('admin.pagos.index')
            ->with('mensaje', 'Registro eliminado del sistema')
            ->with('icono', 'success');
    }
  
    public function generarPDF($id)
    {
        // Cargamos el pago con sus relaciones para obtener datos del trabajador o proveedor
        $pago = Pago::with(['recurso', 'proveedor'])->findOrFail($id);
        
        // Identificamos el beneficiario
        $beneficiario = $pago->recurso_id ? $pago->recurso->nombres . ' ' . $pago->recurso->apellidos : 
                    ($pago->proveedor_id ? $pago->proveedor->razon_social : 'Otros');

        $pdf = Pdf::loadView('admin.pagos.comprobante_pdf', compact('pago', 'beneficiario'));
        
        // Retornamos el PDF para visualizar en el navegador
        return $pdf->stream('comprobante_' . $pago->id . '.pdf');
    }
}