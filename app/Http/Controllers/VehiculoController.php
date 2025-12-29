<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    // 1. Listado de vehículos
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('admin.vehiculos.index', compact('vehiculos'));
    }

    // 2. Formulario de creación
    public function create()
    {
        return view('admin.vehiculos.create');
    }

    // 3. Guardar el vehículo en la BD
    public function store(Request $request)
    {
        $request->validate([
            'codigo_interno' => 'required|unique:vehiculos|max:50',
            'tipo' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'horometro_actual' => 'required|numeric|min:0',
            'estado' => 'required',
        ]);

        Vehiculo::create($request->all());

        return redirect()->route('admin.vehiculos.index')
            ->with('mensaje', 'Vehículo registrado correctamente')
            ->with('icono', 'success');
    }

    // 4. Ver detalles de un vehículo
    public function show($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('admin.vehiculos.show', compact('vehiculo'));
    }

    // 5. Formulario de edición
    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('admin.vehiculos.edit', compact('vehiculo'));
    }

    // 6. Actualizar datos
    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $request->validate([
            'codigo_interno' => 'required|max:50|unique:vehiculos,codigo_interno,',
            'tipo' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'horometro_actual' => 'required|numeric',
            'estado' => 'required',
            'observaciones' => 'nullable|string',
        ]);
        $vehiculo->update($request->all());
        return redirect()->route('admin.vehiculos.index')
            ->with('mensaje', 'Vehículo actualizado correctamente...')
            ->with('icono', 'success');
   }
 
    public function confirmDelete($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('admin.vehiculos.delete', compact('vehiculo'));
    }
    

    // 8. Eliminar de la base de datos
    public function destroy($id)
    {
        Vehiculo::destroy($id);
        return redirect()->route('admin.vehiculos.index')
            ->with('mensaje', 'Vehículo eliminado del sistema')
            ->with('icono', 'success');
    }
}