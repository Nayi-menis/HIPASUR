@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Control de Asistencia de Trabajadores</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ url('/admin/horarios/create') }}" class="btn btn-primary float-right">
                        <i class="bi bi-person-plus-fill"></i> Registrar Entrada
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Monitoreo de Jornadas (Meta: 8 Horas)</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr style="text-align: center">
                                <th>Nro</th>
                                <th>Trabajador</th>
                                <th>Fecha</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Tiempo Total</th>
                                <th>Estado de Jornada</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $contador = 1; @endphp
                            @foreach($horarios as $horario)
                                <tr>
                                    <td style="text-align: center">{{ $contador++ }}</td>
                                    <td>{{ $horario->recurso->nombres }} {{ $horario->recurso->apellidos }}</td>
                                    <td style="text-align: center">{{ $horario->fecha }}</td>
                                    <td style="text-align: center">{{ $horario->hora_entrada }}</td>
                                    <td style="text-align: center">
                                        {{ $horario->hora_salida ?? 'En Mina' }}
                                    </td>
                                    <td style="text-align: center">
                                        @if($horario->hora_salida)
                                            @php
                                                $entrada = \Carbon\Carbon::parse($horario->hora_entrada);
                                                $salida = \Carbon\Carbon::parse($horario->hora_salida);
                                                $horas = $entrada->diffInHours($salida);
                                                $minutos = $entrada->diffInMinutes($salida) % 60;
                                            @endphp
                                            <strong>{{ $horas }}h {{ $minutos }}m</strong>
                                        @else
                                            <span class="text-muted">Calculando...</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        @if(!$horario->hora_salida)
                                            <span class="badge badge-warning p-2"><i class="bi bi-clock"></i> TRABAJANDO</span>
                                        @else
                                            @php
                                                $total_minutos = \Carbon\Carbon::parse($horario->hora_entrada)->diffInMinutes(\Carbon\Carbon::parse($horario->hora_salida));
                                            @endphp
                                            
                                            @if($total_minutos >= 480)
                                                <span class="badge badge-success p-2"><i class="bi bi-check-circle"></i> CUMPLIÓ JORNADA</span>
                                            @else
                                                <span class="badge badge-danger p-2"><i class="bi bi-x-circle"></i> JORNADA INCOMPLETA</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        <div class="btn-group">
                                            <a href="{{ url('/admin/horarios/'.$horario->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                            <a href="{{ url('/admin/horarios/'.$horario->id.'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-clock-history"></i></a>
                                            <a href="{{ url('/admin/horarios/'.$horario->id.'/confirm-delete') }}" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection