<?php

namespace App\Http\Controllers;

use App\Models\Fiscalizacion;
use Illuminate\Http\Request;

class FiscalizacionController extends Controller
{
    /**
     * Muestra la lista de fiscalizaciones.
     */
    public function index()
    {
        $fiscalizaciones = Fiscalizacion::all();
        return view('admin.fiscalizacion.index', compact('fiscalizaciones'));
    }

    /**
     * Muestra el formulario para crear una nueva fiscalización.
     */
    public function create()
    {
        return view('admin.fiscalizacion.create');
    }

    /**
     * Almacena el registro en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha'     => 'required|date',
            'entidad'   => 'required|string|max:255',
            'inspector' => 'required|string|max:255',
            'motivo'    => 'required|string',
            'resultado' => 'required',
        ]);

        Fiscalizacion::create($request->all());

        return redirect()->route('admin.fiscalizacion.index')
            ->with('mensaje', 'Se registró la fiscalización correctamente')
            ->with('icono', 'success');
    }

    /**
     * Muestra el detalle de una fiscalización específica.
     */
    public function show($id)
    {
        $fiscalizacion = Fiscalizacion::findOrFail($id);
        return view('admin.fiscalizacion.show', compact('fiscalizacion'));
    }

    /**
     * Muestra el formulario para editar.
     */
    public function edit($id)
    {
        $fiscalizacion = Fiscalizacion::findOrFail($id);
        return view('admin.fiscalizacion.edit', compact('fiscalizacion'));
    }

    /**
     * Actualiza el registro en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha'     => 'required|date',
            'entidad'   => 'required|string|max:255',
            'resultado' => 'required',
        ]);

        $fiscalizacion = Fiscalizacion::findOrFail($id);
        $fiscalizacion->update($request->all());

        return redirect()->route('admin.fiscalizacion.index')
            ->with('mensaje', 'Fiscalización actualizada con éxito')
            ->with('icono', 'success');
    }

    /**
     * Elimina el registro.
     */
    public function destroy($id)
    {
        $fiscalizacion = Fiscalizacion::findOrFail($id);
        $fiscalizacion->delete();

        return redirect()->route('admin.fiscalizacion.index')
            ->with('mensaje', 'Registro eliminado correctamente')
            ->with('icono', 'success');
    }
}