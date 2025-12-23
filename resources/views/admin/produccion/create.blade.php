@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1>Registrar Producción Diaria</h1>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos de Extracción</h3>
            </div>
            <form action="{{ route('admin.produccion.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Trabajador Responsable</label>
                                <select name="recurso_id" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach($recursos as $recurso)
                                        <option value="{{ $recurso->id }}">{{ $recurso->nombres }} {{ $recurso->apellidos }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Zona / Veta</label>
                                <input type="text" name="zona" class="form-control" placeholder="Ej: Nivel 200 Norte" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cantidad (Tn)</label>
                                <input type="number" step="0.01" name="cantidad" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mineral</label>
                                <select name="tipo_mineral" class="form-control">
                                    <option value="ORO">Oro</option>
                                    <option value="PLATA">Plata</option>
                                    <option value="COBRE">Cobre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha</label>
                                <input type="date" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Guardar Registro</button>
                    <a href="{{ route('admin.produccion.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection