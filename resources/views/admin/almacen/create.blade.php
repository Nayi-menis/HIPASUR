@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Registrar Nuevo Producto / Insumo</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Ingrese los datos del material</h3>
                    </div>
                    <form action="{{ route('admin.almacen.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codigo">Código / SKU</label>
                                        <input type="text" name="codigo" class="form-control" placeholder="Ej: PET-001" required>
                                        @error('codigo') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del Producto</label>
                                        <input type="text" name="nombre" class="form-control" placeholder="Ej: Petróleo Diésel B5" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="categoria">Categoría</label>
                                        <select name="categoria" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            <option value="VÍVERES">VÍVERES</option>
                                            <option value="HERRAMIENTAS">HERRAMIENTAS</option>
                                            <option value="COMBUSTIBLE">COMBUSTIBLE (PETRÓLEO)</option>
                                            <option value="EPP">EPP (SEGURIDAD)</option>
                                            <option value="REPUESTOS">REPUESTOS</option>
                                            <option value="OTROS">OTROS</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="stock">Stock Inicial</label>
                                        <input type="number" name="stock" class="form-control" placeholder="0" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="stock_minimo">Stock Mínimo (Alerta)</label>
                                        <input type="number" name="stock_minimo" class="form-control" value="10" required>
                                        <small class="text-muted">El sistema avisará cuando baje de este número.</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="unidad_medida">Unidad de Medida</label>
                                        <select name="unidad_medida" class="form-control">
                                            <option value="GALONES">GALONES</option>
                                            <option value="UNIDADES">UNIDADES</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="PAQUETES">PAQUETES</option>
                                            <option value="OTROS">OTROS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="precio_unitario">Precio Unitario (Opcional)</label>
                                        <input type="number" step="0.01" name="precio_unitario" class="form-control" placeholder="0.00">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción del Producto</label>
                                        <textarea name="descripcion" rows="2" class="form-control" placeholder="Detalles adicionales..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('admin.almacen.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar en Almacén
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection