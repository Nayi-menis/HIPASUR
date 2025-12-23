@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar Registro de Producción</h1>
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
                        <h3 class="card-title">Modifique los datos necesarios</h3>
                    </div>
                    <form action="{{ url('/admin/produccion/'.$produccion->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Trabajador Responsable</label>
                                        <select name="recurso_id" class="form-control" required>
                                            @foreach($recursos as $recurso)
                                                <option value="{{ $recurso->id }}" {{ $recurso->id == $produccion->recurso_id ? 'selected' : '' }}>
                                                    {{ $recurso->nombres }} {{ $recurso->apellidos }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Fecha de Extracción</label>
                                        <input type="date" name="fecha" value="{{ $produccion->fecha }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Zona / Veta</label>
                                        <input type="text" name="zona" value="{{ $produccion->zona }}" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Tipo de Mineral</label>
                                        <select name="tipo_mineral" class="form-control" required>
                                            <option value="ORO" {{ $produccion->tipo_mineral == 'ORO' ? 'selected' : '' }}>Oro</option>
                                            <option value="PLATA" {{ $produccion->tipo_mineral == 'PLATA' ? 'selected' : '' }}>Plata</option>
                                            <option value="COBRE" {{ $produccion->tipo_mineral == 'COBRE' ? 'selected' : '' }}>Cobre</option>
                                            <option value="ZINC" {{ $produccion->tipo_mineral == 'ZINC' ? 'selected' : '' }}>Zinc</option>
                                            <option value="POLIMETALICO" {{ $produccion->tipo_mineral == 'POLIMETALICO' ? 'selected' : '' }}>Polimetálico</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Cantidad (Toneladas Métricas)</label>
                                        <input type="number" step="0.01" name="cantidad" value="{{ $produccion->cantidad }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Observaciones</label>
                                        <textarea name="observaciones" rows="1" class="form-control">{{ $produccion->observaciones }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('/admin/produccion') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar Registro</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection