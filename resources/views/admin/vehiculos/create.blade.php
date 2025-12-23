@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Registrar Nueva Maquinaria / Vehículo</h1>
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
                        <h3 class="card-title">Ingrese los datos de la unidad</h3>
                    </div>
                    <form action="{{ url('admin/vehiculos/create') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="codigo_interno">Código Interno</label>
                                        <input type="text" name="codigo_interno" class="form-control" placeholder="Ej: EXCA-001" value="{{ old('codigo_interno') }}" required>
                                        @error('codigo_interno') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipo">Tipo de Unidad</label>
                                        <select name="tipo" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            <option value="CAMIONETA">CAMIONETA</option>
                                            <option value="EXCAVADORA">EXCAVADORA</option>
                                            <option value="VOLQUETE">VOLQUETE</option>
                                            <option value="CARGADOR FRONTAL">CARGADOR FRONTAL</option>
                                            <option value="RETROEXCAVADORA">RETROEXCAVADORA</option>
                                            <option value="MINI">VEHÍCULO LIVIANO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="placa">Placa (Opcional)</label>
                                        <input type="text" name="placa" class="form-control" placeholder="ABC-123" value="{{ old('placa') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="estado">Estado Inicial</label>
                                        <select name="estado" class="form-control" required>
                                            <option value="OPERATIVO">OPERATIVO</option>
                                            <option value="EN MANTENIMIENTO">EN MANTENIMIENTO</option>
                                            <option value="FUERA DE SERVICIO">FUERA DE SERVICIO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="marca">Marca</label>
                                        <input type="text" name="marca" class="form-control" placeholder="Ej: Caterpillar, Toyota" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="modelo">Modelo</label>
                                        <input type="text" name="modelo" class="form-control" placeholder="Ej: 320D, Hilux" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="serie_motor">Serie de Motor / Chasis</label>
                                        <input type="text" name="serie_motor" class="form-control" placeholder="Número de serie">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción / Notas Adicionales</label>
                                        <textarea name="descripcion" rows="3" class="form-control" placeholder="Detalles sobre el seguro, vencimiento de revisión técnica, etc..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ url('admin/vehiculos') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Vehículo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection