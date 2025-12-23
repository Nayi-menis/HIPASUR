<?php

namespace App\Http\Controllers;

use App\Models\Produccion;
use App\Models\Recurso;
use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    /**
     * Muestra el listado de producción minera.
     */
    public function index()
    {
        // Cargamos la producción junto con la relación del trabajador (recurso)
        $producciones = Produccion::with('recurso')->orderBy('fecha', 'desc')->get();
        return view('admin.produccion.index', compact('producciones'));
    }

    /**
     * Muestra el formulario para registrar una nueva producción.
     */
    public function create()
    {
        // Necesitamos los trabajadores para el select del formulario
        $recursos = Recurso::all();
        return view('admin.produccion.create', compact('recursos'));
    }

    /**
     * Almacena el registro en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'recurso_id' => 'required',
            'fecha' => 'required|date',
            'zona' => 'required',
            'cantidad' => 'required|numeric',
            'tipo_mineral' => 'required',
        ]);

        $produccion = new \App\Models\Produccion();
        $produccion->recurso_id = $request->recurso_id;
        $produccion->fecha = $request->fecha;
        $produccion->zona = $request->zona;
        $produccion->cantidad = $request->cantidad;
        $produccion->tipo_mineral = $request->tipo_mineral;
        $produccion->observaciones = $request->observaciones;
        $produccion->save();

        return redirect()->route('admin.produccion.index')
            ->with('mensaje', 'Producción registrada con éxito')
            ->with('icono', 'success');
    }

    /**
     * Muestra el detalle de un registro específico.
     */
    public function show($id)
    {
        $produccion = Produccion::with('recurso')->findOrFail($id);
        return view('admin.produccion.show', compact('produccion'));
    }

    /**
     * Muestra el formulario para editar un registro.
     */
    public function edit($id)
    {
        $produccion = Produccion::findOrFail($id);
        $recursos = Recurso::all();
        return view('admin.produccion.edit', compact('produccion', 'recursos'));
    }

    /**
     * Actualiza el registro en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'zona' => 'required|string|max:255',
            'cantidad' => 'required|numeric',
            'tipo_mineral' => 'required|string',
            'recurso_id' => 'required|exists:recursos,id',
        ]);

        $produccion = Produccion::findOrFail($id);
        $produccion->update($request->all());

        return redirect()->route('admin.produccion.index')
            ->with('mensaje', 'Registro de producción actualizado')
            ->with('icono', 'success');
    }

    /**
     * Elimina un registro de producción.
     */
    public function destroy($id)
    {
        Produccion::destroy($id);
        return redirect()->route('admin.produccion.index')
            ->with('mensaje', 'Registro eliminado correctamente')
            ->with('icono', 'success');
    }
}