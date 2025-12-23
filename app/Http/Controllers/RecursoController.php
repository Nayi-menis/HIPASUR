<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RecursoController extends Controller
{
    public function index()
    {
        $recursos = Recurso::with('user')->get();
        return view('admin.recursos.index', compact('recursos'));
    }

    public function create()
    {
        return view('admin.recursos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'edad' => 'required',
            'DNI' => 'required|unique:recursos,DNI',
            'celular' => 'required',
            'fecha_nacimiento' => 'required',
            'cuenta' => 'required|unique:recursos,cuenta',
            'stc' => 'required|unique:recursos,stc',
            'departamento' => 'required',
            'provincia' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        DB::beginTransaction();
        try {
            // 1. Crear el Usuario vinculado
            $usuario = new User();
            $usuario->name = $request->nombres;
            $usuario->email = $request->email;
            // No asignamos password porque ya es nullable en la BD
            $usuario->save();

            // 2. Crear el Recurso en el orden de tu tabla
            $recurso = new Recurso();
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
            $recurso->user_id = $usuario->id;
            $recurso->save();

            DB::commit();

            return redirect()->route('admin.recursos.index')
                 ->with('mensaje', 'Se registró correctamente al trabajador')
                 ->with('icono', 'success');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                 ->with('mensaje', 'Error al registrar: ' . $e->getMessage())
                 ->with('icono', 'error');
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
        return view('admin.recursos.edit', compact('recurso'));
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