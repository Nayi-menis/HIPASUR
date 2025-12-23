@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Eliminar Registro de Asistencia</h1>
    </div>
    <hr>
    <div class="col-md-10">
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title">¿Está seguro de eliminar este registro?</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i> 
                    Esta acción no se puede deshacer. Se eliminará el historial de turno del trabajador.
                </div>

                <form action="{{ url('/admin/horarios', $horario->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Trabajador</label>
                                <input type="text" value="{{ $horario->recurso->nombres }} {{ $horario->recurso->apellidos }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>DNI</label>
                                <input type="text" value="{{ $horario->recurso->DNI }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Fecha del Turno</label>
                                <input type="date" value="{{ $horario->fecha }}" class="form-control" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Turno</label>
                                <input type="text" value="{{ $horario->turno }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Entrada</label>
                                <input type="time" value="{{ $horario->hora_entrada }}" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Salida</label>
                                <input type="time" value="{{ $horario->hora_salida ?? 'En turno' }}" class="form-control" disabled>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('admin/horarios') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Eliminar definitivamente
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection