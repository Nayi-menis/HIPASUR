<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsuarioController extends Controller
{

    
    public function index()
    {
        // Esto trae a todos los usuarios con sus columnas actualizadas (incluyendo 'role')
        $usuarios = \App\Models\User::all();
        
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create (){
        return view('admin.usuarios.create');
    }

   public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // Actualizamos la lista para que coincida con lo que envías en la vista
            'role' => 'required|in:ADMINISTRADOR,SECRETARIA,TRABAJADOR,PERSONAL,ENCARGADO,administrador,secretaria,personal,encargado',
        ]);

        // 2. Creamos el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role' => strtoupper($request->role), // Lo guardamos siempre en mayúsculas para estandarizar
        ]);

        return redirect()->route('admin.usuarios.index')
                        ->with('mensaje', 'Usuario registrado correctamente')
                        ->with('icono', 'success');
    }

    public function show($id){
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));

    }

    public function edit($id){
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));

    }

    public function update(Request $request, $id){
        $usuario = User::findOrFail($id);
        $request->validate([
            'name'=>'required|max:250',
            'email'=>'required|max:250|unique:users,email,' .$usuario->id,
            'password'=>'nullable|max:250|confirmed',
            'role'=>'required|in:administrador,secretaria,personal,encargado',
        ]);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->role = $request->role;
        if($request->filled('password')){
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Se actualizo correctamente :D')
            ->with('icono', 'success');

    }

    public function confirmDelete($id){
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.delete', compact('usuario'));
    }

    public function destroy($id){
        User::destroy($id);
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Se elimino correctamente :D')
            ->with('icono', 'success');

    }
}

