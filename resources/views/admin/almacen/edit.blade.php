@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar Producto / Insumo</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Modificar datos de: {{ $producto->nombre }}</h3>
                    </div>
                    <form action="{{ route('admin.almacen.update', $producto->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codigo">Código / SKU</label>
                                        <input type="text" name="codigo" value="{{ $producto->codigo }}" class="form-control" required>
                                        @error('codigo') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del Producto</label>
                                        <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="categoria">Categoría</label>
                                        <select name="categoria" class="form-control" required>
                                            @foreach(['VÍVERES', 'HERRAMIENTAS', 'COMBUSTIBLE', 'EPP', 'REPUESTOS'] as $cat)
                                                <option value="{{ $cat }}" {{ $producto->categoria == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="stock">Stock Actual</label>
                                        <input type="number" name="stock" value="{{ $producto->stock }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="stock_minimo">Stock Mínimo (Alerta)</label>
                                        <input type="number" name="stock_minimo" value="{{ $producto->stock_minimo }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="unidad_medida">Unidad de Medida</label>
                                        <select name="unidad_medida" class="form-control">
                                            @foreach(['GALONES', 'UNIDADES', 'KILOS', 'LITROS', 'PAQUETES'] as $unidad)
                                                <option value="{{ $unidad }}" {{ $producto->unidad_medida == $unidad ? 'selected' : '' }}>{{ $unidad }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="precio_unitario">Precio Unitario</label>
                                        <input type="number" step="0.01" name="precio_unitario" value="{{ $producto->precio_unitario }}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <textarea name="descripcion" rows="2" class="form-control">{{ $producto->descripcion }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('admin.almacen.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-sync"></i> Actualizar Producto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection