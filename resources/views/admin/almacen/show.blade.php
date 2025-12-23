@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detalle del Producto</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Información de Inventario</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.almacen.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center border-right">
                        <i class="fas fa-boxes fa-10x text-info"></i>
                        <h4 class="mt-3">{{ $producto->nombre }}</h4>
                        <span class="badge badge-primary">{{ $producto->categoria }}</span>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-hover">
                            <tr>
                                <th>Código:</th>
                                <td>{{ $producto->codigo }}</td>
                            </tr>
                            <tr>
                                <th>Stock Actual:</th>
                                <td class="{{ $producto->stock <= $producto->stock_minimo ? 'text-danger font-weight-bold' : '' }}">
                                    {{ $producto->stock }} {{ $producto->unidad_medida }}
                                </td>
                            </tr>
                            <tr>
                                <th>Stock Mínimo Permitido:</th>
                                <td>{{ $producto->stock_minimo }} {{ $producto->unidad_medida }}</td>
                            </tr>
                            <tr>
                                <th>Precio Unitario:</th>
                                <td>S/. {{ number_format($producto->precio_unitario, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Descripción:</th>
                                <td>{{ $producto->descripcion ?? 'Sin descripción adicional.' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('admin.almacen.edit', $producto->id) }}" class="btn btn-success">
                    <i class="fas fa-edit"></i> Editar Producto
                </a>
            </div>
        </div>
    </div>
</div>
@endsection