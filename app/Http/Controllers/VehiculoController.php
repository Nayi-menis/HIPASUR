<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Muestra el listado de vehículos/maquinaria.
     */
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('admin.vehiculos.index', compact('vehiculos'));
    }

    /**
     * Muestra el formulario para registrar nueva maquinaria.
     */
    public function create()
    {
        return view('admin.vehiculos.create');
    }

    /**
     * Almacena el vehículo en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo_interno' => 'required|unique:vehiculos,codigo_interno',
            'tipo'           => 'required',
            'marca'          => 'required',
            'modelo'         => 'required',
            'estado'         => 'required'
        ]);

        Vehiculo::create($request->all());

        return redirect()->route('admin.vehiculos.index')
            ->with('mensaje', 'Vehículo/Maquinaria registrado con éxito')
            ->with('icono', 'success');
    }

    /**
     * Muestra el detalle de un vehículo específico.
     */
    public function show($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('admin.vehiculos.show', compact('vehiculo'));
    }

    /**
     * Muestra el formulario para editar datos de la máquina.
     */
    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('admin.vehiculos.edit', compact('vehiculo'));
    }

    /**
     * Actualiza la información en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo_interno' => 'required|unique:vehiculos,codigo_interno,'.$id,
            'tipo'           => 'required',
            'estado'         => 'required'
        ]);

        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->update($request->all());

        return redirect()->route('admin.vehiculos.index')
            ->with('mensaje', 'Información actualizada correctamente')
            ->with('icono', 'success');
    }

    /**
     * Elimina el registro de la unidad.
     */
    public function destroy($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->delete();

        return redirect()->route('admin.vehiculos.index')
            ->with('mensaje', 'Vehículo eliminado correctamente')
            ->with('icono', 'success');
    }
}