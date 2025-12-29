<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('admin.proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('admin.proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruc' => 'required|unique:proveedores,ruc',
            'razon_social' => 'required',
            'banco' => 'required',
            'nro_cuenta' => 'required',
            'tipo_cuenta' => 'required'
        ]);

        Proveedor::create($request->all());

        return redirect()->route('admin.proveedores.index')
            ->with('mensaje', 'Proveedor registrado correctamente')
            ->with('icono', 'success');
    }
}