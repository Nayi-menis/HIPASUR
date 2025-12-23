<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\Recurso; // Importante para las relaciones de personal
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    /**
     * Muestra el listado de productos en el inventario.
     */
    public function index()
    {
        $productos = Almacen::all();
        return view('admin.almacen.index', compact('productos'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        $categorias = ['VÍVERES', 'HERRAMIENTAS', 'COMBUSTIBLE (PETRÓLEO)', 'EPP', 'REPUESTOS'];
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