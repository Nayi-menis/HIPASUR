@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar Unidad: {{ $vehiculo->codigo_interno }}</h1>
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
                    <form action="{{ url('admin/vehiculos/' . $vehiculo->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- ESTO ES VITAL PARA QUE LARAVEL SEPA QUE ES UNA ACTUALIZACIÓN --}}
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codigo_interno">Código Interno</label>
                                        <input type="text" name="codigo_interno" class="form-control" value="{{ old('codigo_interno', $vehiculo->codigo_interno) }}" required>
                                        @error('codigo_interno') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipo">Tipo de Unidad</label>
                                        <select name="tipo" class="form-control" required>
                                            <option value="CAMIONETA" {{ $vehiculo->tipo == 'CAMIONETA' ? 'selected' : '' }}>CAMIONETA</option>
                                            <option value="EXCAVADORA" {{ $vehiculo->tipo == 'EXCAVADORA' ? 'selected' : '' }}>EXCAVADORA</option>
                                            <option value="VOLQUETE" {{ $vehiculo->tipo == 'VOLQUETE' ? 'selected' : '' }}>VOLQUETE</option>
                                            <option value="CARGADOR FRONTAL" {{ $vehiculo->tipo == 'CARGADOR FRONTAL' ? 'selected' : '' }}>CARGADOR FRONTAL</option>
                                            <option value="RETROEXCAVADORA" {{ $vehiculo->tipo == 'RETROEXCAVADORA' ? 'selected' : '' }}>RETROEXCAVADORA</option>
                                            <option value="VEHÍCULO LIVIANO" {{ $vehiculo->tipo == 'VEHÍCULO LIVIANO' ? 'selected' : '' }}>VEHÍCULO LIVIANO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="placa">Placa</label>
                                        <input type="text" name="placa" class="form-control" value="{{ old('placa', $vehiculo->placa) }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="estado">Estado</label>
                                        <select name="estado" class="form-control" required>
                                            <option value="OPERATIVO" {{ $vehiculo->estado == 'OPERATIVO' ? 'selected' : '' }}>OPERATIVO</option>
                                            <option value="EN MANTENIMIENTO" {{ $vehiculo->estado == 'EN MANTENIMIENTO' ? 'selected' : '' }}>EN MANTENIMIENTO</option>
                                            <option value="FUERA DE SERVICIO" {{ $vehiculo->estado == 'FUERA DE SERVICIO' ? 'selected' : '' }}>FUERA DE SERVICIO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="marca">Marca</label>
                                        <input type="text" name="marca" class="form-control" value="{{ old('marca', $vehiculo->marca) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="modelo">Modelo</label>
                                        <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $vehiculo->modelo) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="serie_motor">Serie de Motor</label>
                                        <input type="text" name="serie_motor" class="form-control" value="{{ old('serie_motor', $vehiculo->serie_motor) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción / Notas Adicionales</label>
                                        <textarea name="descripcion" rows="3" class="form-control">{{ old('descripcion', $vehiculo->descripcion) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{url('admin/vehiculos') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-sync"></i> Actualizar Vehículo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection