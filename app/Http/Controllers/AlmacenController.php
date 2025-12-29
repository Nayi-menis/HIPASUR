<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Recurso; // Importante para las relaciones de personal
use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\User;

class AlmacenController extends Controller
{
    /**
     * Muestra el listado de productos en el inventario.
     */
    // En app/Http/Controllers/AlmacenController.php
 // Asegúrate de importar el modelo User

    public function index()
    {
    $productos = Almacen::all();
      $movimientos = \App\Models\Movimiento::with(['user', 'almacen'])->latest()->take(10)->get();
    $usuarios = \App\Models\User::orderBy('name', 'asc')->get();
    $productosBajos = Almacen::where('stock', '<', 10)->get();

    return view('admin.almacen.index', compact('productos', 'movimientos', 'usuarios','productosBajos'));
    }
    
    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        $categorias = ['VÍVERES', 'HERRAMIENTAS', 'COMBUSTIBLE (PETRÓLEO)', 'EPP', 'REPUESTOS','OTROS'];
        return view('admin.almacen.create', compact('categorias'));
    }

    /**
     * Almacena un producto recién creado en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:almacens,codigo',
            'nombre' => 'required',
            'stock'  => 'required|numeric|min:0',
            'categoria' => 'required',
            'stock_minimo' => 'required|numeric'
        ]);

        Almacen::create($request->all());

        return redirect()->route('admin.almacen.index')
            ->with('mensaje', 'Producto registrado exitosamente en el almacén')
            ->with('icono', 'success');
    }

    /**
     * Muestra el detalle de un producto específico.
     */
    public function show($id)
    {
        $producto = Almacen::findOrFail($id);
        return view('admin.almacen.show', compact('producto'));
    }

    /**
     * Muestra el formulario para editar un producto.
     */
    public function edit($id)
    {
        $producto = Almacen::findOrFail($id);
        $categorias = ['VÍVERES', 'HERRAMIENTAS', 'COMBUSTIBLE (PETRÓLEO)', 'EPP', 'REPUESTOS'];
        return view('admin.almacen.edit', compact('producto', 'categorias'));
    }

    /**
     * Actualiza el producto en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required|unique:almacens,codigo,'.$id,
            'nombre' => 'required',
            'stock'  => 'required|numeric|min:0',
        ]);

        $producto = Almacen::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('admin.almacen.index')
            ->with('mensaje', 'El producto ha sido actualizado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Elimina un producto del almacén.
     */
    public function destroy($id)
    {
        $producto = Almacen::findOrFail($id);
        $producto->delete();

        return redirect()->route('admin.almacen.index')
            ->with('mensaje', 'Producto eliminado del inventario')
            ->with('icono', 'success');
    }
}