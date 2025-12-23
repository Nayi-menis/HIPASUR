@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Detalle del Turno: {{ $horario->recurso->nombres }} {{ $horario->recurso->apellidos }}</h1>
    </div>
    <hr>
    <div class="col-md-10">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Información Registrada</h3>
            </div>
            <div class="card-body">
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
                            <label>Fecha de Turno</label>
                            <input type="date" value="{{ $horario->fecha }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Turno Asignado</label>
                            <input type="text" value="{{ $horario->turno }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Hora de Entrada</label>
                            <input type="time" value="{{ $horario->hora_entrada }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Hora de Salida</label>
                            <input type="time" value="{{ $horario->hora_salida ?? 'Sin registrar' }}" class="form-control" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observaciones o Tareas Realizadas</label>
                            <textarea class="form-control" rows="3" disabled>{{ $horario->observaciones }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fecha de Registro en Sistema</label>
                            <p class="text-muted">{{ $horario->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ url('admin/horarios') }}" class="btn btn-secondary">Volver al listado</a>
                        <a href="{{ url('admin/horarios/'.$horario->id.'/edit') }}" class="btn btn-success">Editar este registro</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection