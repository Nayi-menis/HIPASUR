@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Registro de Turno y Asistencia</h1>
    </div>
    <hr>
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Completar los datos del turno</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/admin/horarios') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Trabajador de Mina</label>
                                <select name="recurso_id" class="form-control" required>
                                    <option value="">Seleccione al trabajador...</option>
                                    @foreach($recursos as $recurso)
                                        <option value="{{ $recurso->id }}">{{ $recurso->nombres }} {{ $recurso->apellidos }} - DNI: {{ $recurso->DNI }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Fecha</label>
                                <input type="date" name="fecha" value="{{ date('Y-m-d') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Turno</label>
                                <select name="turno" class="form-control" required>
                                    <option value="MAÑANA">MAÑANA</option>
                                    <option value="TARDE">TARDE</option>
                                    <option value="NOCHE">NOCHE</option>
                                    <option value="GUARDIA">GUARDIA</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Hora de Entrada</label>
                                <input type="time" name="hora_entrada" id="hora_entrada" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Hora de Salida (Estimada 8h)</label>
                                <input type="time" name="hora_salida" id="hora_salida" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Observaciones / Tarea en Mina</label>
                                <textarea name="observaciones" class="form-control" rows="2" placeholder="Ej: Zona de excavación norte..."></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('admin/horarios') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Script para sugerir 8 horas de trabajo automáticamente
        document.getElementById('hora_entrada').addEventListener('change', function() {
            let entrada = this.value;
            if (entrada) {
                let [horas, minutos] = entrada.split(':');
                let salidaHoras = (parseInt(horas) + 8) % 24;
                document.getElementById('hora_salida').value = 
                    (salidaHoras < 10 ? '0' : '') + salidaHoras + ':' + minutos;
            }
        });
    </script>
@endsection