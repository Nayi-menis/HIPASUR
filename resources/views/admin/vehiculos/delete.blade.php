@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Eliminar Vehículo</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-10">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">¿Está seguro de eliminar este registro?</h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin/vehiculos/destroy', $vehiculo->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Código Interno</label>
                                <input type="text" value="{{ $vehiculo->codigo_interno }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo</label>
                                <input type="text" value="{{ $vehiculo->tipo }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Marca / Modelo</label>
                                <input type="text" value="{{ $vehiculo->marca }} {{ $vehiculo->modelo }}" class="form-control" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a href="{{url('admin/vehiculos/index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Eliminar Definitivamente
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection