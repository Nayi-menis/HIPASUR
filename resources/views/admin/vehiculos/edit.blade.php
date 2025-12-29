@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Editar Unidad: {{ $vehiculo->placa }}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Modifique los datos necesarios</h3>
                </div>
                <div class="card-body">
                    {{-- Usamos URL concatenando el ID --}}
                    <form action="{{url('admin/vehiculos', $vehiculo->id)}}" method="POST">
                        @csrf
                        @method('PUT') {{-- VITAL para que Laravel sepa que es actualización --}}
                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Código Interno</label>
                                    <input type="text" name="codigo_interno" value="{{ $vehiculo->codigo_interno }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Tipo de Unidad</label>
                                    <select name="tipo" class="form-control">
                                        <option value="VOLQUETE" {{ $vehiculo->tipo == 'VOLQUETE' ? 'selected' : '' }}>VOLQUETE</option>
                                        <option value="CAMIONETA" {{ $vehiculo->tipo == 'CAMIONETA' ? 'selected' : '' }}>CAMIONETA</option>
                                        <option value="MAQUINARIA" {{ $vehiculo->tipo == 'MAQUINARIA' ? 'selected' : '' }}>CARGADOR</option>
                                        <option value="MAQUINARIA" {{ $vehiculo->tipo == 'MAQUINARIA' ? 'selected' : '' }}>ESCAVADORA</option>
                                        <option value="MAQUINARIA" {{ $vehiculo->tipo == 'MAQUINARIA' ? 'selected' : '' }}>OTRO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Placa</label>
                                    <input type="text" name="placa" value="{{ $vehiculo->placa }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <select name="estado" class="form-control">
                                        <option value="OPERATIVO" {{ $vehiculo->estado == 'OPERATIVO' ? 'selected' : '' }}>OPERATIVO</option>
                                        <option value="MANTENIMIENTO" {{ $vehiculo->estado == 'MANTENIMIENTO' ? 'selected' : '' }}>MANTENIMIENTO</option>
                                        <option value="FUERA DE SERVICIO" {{ $vehiculo->estado == 'FUERA DE SERVICIO' ? 'selected' : '' }}>FUERA DE SERVICIO</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Marca</label>
                                    <input type="text" name="marca" value="{{ $vehiculo->marca }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Modelo</label>
                                    <input type="text" name="modelo" value="{{ $vehiculo->modelo }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Descripción / Notas Adicionales</label>
                                    <textarea name="observaciones" rows="3" class="form-control">{{ $vehiculo->observaciones }}</textarea>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ url('admin/vehiculos') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-arrow-clockwise"></i> Actualizar Vehículo
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection