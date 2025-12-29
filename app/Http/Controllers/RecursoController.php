<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Vehiculo; 


class RecursoController extends Controller
{
    public function index()
    {
        $recursos = Recurso::with(['user', 'vehiculo'])->get(); 
        return view('admin.recursos.index', compact('recursos'));
    }

    public function create() 
    {
        $usuarios = \App\Models\User::where('role', 'personal')->whereDoesntHave('recurso')->get();
        $vehiculos = \App\Models\Vehiculo::where('estado', 'OPERATIVO')->get(); // Solo vehículos listos
        return view('admin.recursos.create', compact('usuarios', 'vehiculos'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:recursos,user_id',
            'DNI'     => 'required|unique:recursos,DNI',
            'cuenta'  => 'required|unique:recursos,cuenta',
            'stc'     => 'required|unique:recursos,stc',
            'email'   => 'required|email|unique:recursos,email',
            'cargo'   => 'required',
            'vehiculo_id' => 'required'
        ], [
            // Mensajes específicos para campos únicos
            'user_id.unique' => 'Este usuario ya tiene un expediente de trabajador asignado.',
            'DNI.unique'     => 'El número de DNI ya está registrado en el sistema.',
            'cuenta.unique'  => 'Esta cuenta bancaria ya pertenece a otro trabajador.',
            'stc.unique'     => 'La cuenta STC ya existe.',
            'email.unique'   => 'Este correo electrónico ya está en uso.',
        ]);

        try {
            $recurso = new \App\Models\Recurso();
            $recurso->fill($request->all());
            $recurso->save();

            return redirect()->route('admin.recursos.index')
                ->with('mensaje', 'Se registró correctamente al trabajador')
                ->with('icono', 'success');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error de base de datos: ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $recurso = Recurso::findOrFail($id);
        return view('admin.recursos.show', compact('recurso'));
    }

    public function edit($id)
    {
        $recurso = Recurso::findOrFail($id);
        
        // Obtener todos los vehículos para el select
        $vehiculos = Vehiculo::all(); 
        
        return view('admin.recursos.edit', compact('recurso', 'vehiculos'));
    }

    public function update(Request $request, $id)
    {
        $recurso = Recurso::find($id);
        $usuario = User::find($recurso->user_id);

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'edad' => 'required',
            'DNI' => ['required', Rule::unique('recursos')->ignore($recurso->id)],
            'celular' => 'required',
            'fecha_nacimiento' => 'required',
            'cuenta' => ['required', Rule::unique('recursos')->ignore($recurso->id)],
            'stc' => ['required', Rule::unique('recursos')->ignore($recurso->id)],
            'departamento' => 'required',
            'provincia' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($usuario->id)],
        ]);

        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->save();

        $recurso->nombres = $request->nombres;
        $recurso->apellidos = $request->apellidos;
        $recurso->edad = $request->edad;
        $recurso->DNI = $request->DNI;
        $recurso->celular = $request->celular;
        $recurso->fecha_nacimiento = $request->fecha_nacimiento;
        $recurso->cuenta = $request->cuenta;
        $recurso->stc = $request->stc;
        $recurso->departamento = $request->departamento;
        $recurso->provincia = $request->provincia;
        $recurso->email = $request->email;
        $recurso->save();

        return redirect()->route('admin.recursos.index')
             ->with('mensaje', 'Se actualizó correctamente')
             ->with('icono', 'success');
    }


    public function confirmDelete($id)
    {
         $recurso = Recurso::findOrFail($id);
         return view('admin.recursos.delete', compact('recurso'));
    }
    

    public function destroy($id)
    {
        $recurso = Recurso::findOrFail($id);
        User::destroy($recurso->user_id); // Borra al usuario y por cascada al recurso
        
        return redirect()->route('admin.recursos.index')
            ->with('mensaje', 'Se eliminó correctamente')
            ->with('icono', 'success');
    }


}
