@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Actualizar Turno: {{ $horario->recurso->nombres }} {{ $horario->recurso->apellidos }}</h1>
    </div>
    <hr>
    <div class="col-md-10">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Modificar Datos de Asistencia</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/horarios', $horario->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Trabajador</label>
                                <select name="recurso_id" class="form-control" disabled>
                                    <option value="{{ $horario->recurso_id }}">
                                        {{ $horario->recurso->nombres }} {{ $horario->recurso->apellidos }}
                                    </option>
                                </select>
                                <input type="hidden" name="recurso_id" value="{{ $horario->recurso_id }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Fecha</label>
                                <input type="date" name="fecha" value="{{ $horario->fecha }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Turno</label>
                                <select name="turno" class="form-control" required>
                                    <option value="MAÑANA" {{ $horario->turno == 'MAÑANA' ? 'selected' : '' }}>MAÑANA</option>
                                    <option value="TARDE" {{ $horario->turno == 'TARDE' ? 'selected' : '' }}>TARDE</option>
                                    <option value="NOCHE" {{ $horario->turno == 'NOCHE' ? 'selected' : '' }}>NOCHE</option>
                                    <option value="GUARDIA" {{ $horario->turno == 'GUARDIA' ? 'selected' : '' }}>GUARDIA</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Hora de Entrada</label>
                                <input type="time" name="hora_entrada" value="{{ $horario->hora_entrada }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Hora de Salida (Marcar al finalizar)</label>
                                <input type="time" name="hora_salida" value="{{ $horario->hora_salida }}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Observaciones / Incidencias en Turno</label>
                                <textarea name="observaciones" class="form-control" rows="3">{{ $horario->observaciones }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('admin/horarios') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar Registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection