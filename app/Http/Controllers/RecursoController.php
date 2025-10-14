<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RecursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recursos = Recurso::with('user')->get();
        return view('admin.recursos.index', compact('recursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.recursos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        /* $datos = request()->all();
        return response()->json($datos); */
        $request->validate([
            'nombres'=>'required',
            'apellidos'=>'required',
            'edad' => 'required',
            'DNI'=>'required|unique:secretarias',
            'celular'=>'required',
            'fecha_nacimiento'=>'required',
            'departamento'=>'required',
            'provincia'=>'required',
            'email'=>'required|max:250|unique:users',
            #'password'=>'required|max:250|confirmed',
        ]);

        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        #$usuario->password = Hash::make($request['password']);
        $usuario->save();

        $recurso = new Recurso();
        $recurso->user_id = $usuario->id;
        $recurso->nombres = $request->nombres;
        $recurso->apellidos = $request->apellidos;
        $recurso->edad = $request->edad;
        $recurso->DNI = $request->DNI;
        $recurso->celular = $request->celular;
        $recurso->fecha_nacimiento = $request->fecha_nacimiento;
        $recurso->departamento = $request->departamento;
        $recurso->provincia = $request->provincia;
        $recurso->save();

        return redirect()->route('admin.recursos.index')
             ->with('mensaje', 'Se registro correctamente :D')
             ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $recurso = Recurso::with('user')->findOrFail($id);
        return view('admin.recursos.show', compact('recurso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $recurso = Recurso::with('user')->findOrFail($id);
        return view('admin.recursos.edit', compact('recurso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $recurso = Recurso::find($id);       
        $request->validate([
            'nombres'=>'required',
            'apellidos'=>'required',
            'edad'=>'required',
            'DNI'=>'required|unique:recursos,DNI,'.$recurso->id,
            'celular'=>'required',
            'fecha_nacimiento'=>'required',
            'departamento'=>'required',
            'provincia'=>'required',
            'email'=>'required|max:250|unique:users,email,'.$recurso->user->id,
            #'password'=>'nullable|max:250|confirmed',
        ]);

        $recurso->nombres = $request->nombres;
        $recurso->apellidos = $request->apellidos;
        $recurso->edad = $request->edad;
        $recurso->DNI = $request->DNI;
        $recurso->celular = $request->celular;
        $recurso->fecha_nacimiento = $request->fecha_nacimiento;
        $recurso->departamento = $request->direccion;
        $recurso->provincia = $request->direccion;
        $recurso->save();

        $usuario = User::find($recurso->user->id);
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        #if($request->filled('password')){
        #   $usuario->password = Hash::make($request['password']);
        #}
        $usuario->save();
        return redirect()->route('admin.recursos.index')
            ->with('mensaje', 'Se actualizo correctamente :D')
            ->with('icono', 'success');
    }

    public function confirmDelete($id){
        $recurso = Recurso::with('user')->findOrFail($id);
        return view('admin.recursos.delete', compact('recurso'));
        
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $recurso = Recurso::find($id);  
        #eliminara al usurio asociado
        $user = $recurso->user;
        $user->delete();
        #eliminara al trabajador asociado
        $recurso->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Se elimino correctamente :D')
            ->with('icono', 'success');
    }

}
