<?php

namespace App\Http\Controllers;

use App\Models\SeguridadSalud;
use Illuminate\Http\Request;

class SeguridadSaludController extends Controller
{
    /**
     * Listado de registros de seguridad.
     */
    public function index()
    {
        $registros = SeguridadSalud::all();
        return view('admin.seguridad.index', compact('registros'));
    }
    

    /**
     * Formulario de creación.
     */
    public function create()
    {
        return view('admin.seguridad.create');
    }

    /**
     * Guardar nuevo registro.
     */
    public function store(Request $request)
    {
        // Validación estricta para evitar datos vacíos
        $request->validate([
            'fecha'         => 'required|date',
            'tipo_registro' => 'required',
            'area'          => 'required',
            'responsable'   => 'required',
            'nivel_riesgo'  => 'required',
            'descripcion'   => 'required',
        ]);

        SeguridadSalud::create($request->all());

        return redirect()->route('admin.seguridad.index')
            ->with('mensaje', 'Registro de seguridad guardado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Ver detalle del registro.
     */
    public function show($id)
    {
        $seguridad = SeguridadSalud::findOrFail($id);
        return view('admin.seguridad.show', compact('seguridad'));
    }

    /**
     * Formulario de edición.
     */
    public function edit($id)
    {
        $seguridad = SeguridadSalud::findOrFail($id);
        return view('admin.seguridad.edit', compact('seguridad'));
    }

    /**
     * Actualizar registro.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha'         => 'required|date',
            'tipo_registro' => 'required',
            'nivel_riesgo'  => 'required',
            'descripcion'   => 'required',
        ]);

        $seguridad = SeguridadSalud::findOrFail($id);
        $seguridad->update($request->all());

        return redirect()->route('admin.seguridad.index')
            ->with('mensaje', 'Registro actualizado con éxito')
            ->with('icono', 'success');
    }

    /**
     * Eliminar registro.
     */
    public function destroy($id)
    {
        $seguridad = SeguridadSalud::findOrFail($id);
        $seguridad->delete();

        return redirect()->route('admin.seguridad.index')
            ->with('mensaje', 'Registro eliminado correctamente')
            ->with('icono', 'success');
    }
}