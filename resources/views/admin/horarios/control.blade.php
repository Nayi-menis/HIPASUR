@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1>Control de Asistencia Detallado</h1>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-success">
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-sm text-center">
                    <thead>
                        <tr class="bg-secondary">
                            <th>Nro</th>
                            <th>Trabajador</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Horas Trabajadas</th>
                            <th>Estado de Jornada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trabajadores as $index => $trabajador)
                            @php 
                                $asistencia = $trabajador->horarios->first(); 
                                $horasTotal = 0;
                                $estado = 'FALTO';
                                $color = 'danger';

                                if($asistencia) {
                                    if($asistencia->hora_salida) {
                                        $e = \Carbon\Carbon::parse($asistencia->hora_entrada);
                                        $s = \Carbon\Carbon::parse($asistencia->hora_salida);
                                        $horasTotal = number_format($e->diffInMinutes($s) / 60, 2);
                                        
                                        if($horasTotal >= 8) {
                                            $estado = 'COMPLETO';
                                            $color = 'success';
                                        } else {
                                            $estado = 'INCOMPLETO';
                                            $color = 'warning';
                                        }
                                    } else {
                                        $estado = 'EN TURNO';
                                        $color = 'info';
                                    }
                                }
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-left">{{ $trabajador->nombres }} {{ $trabajador->apellidos }}</td>
                                <td>{{ $asistencia->hora_entrada ?? '--:--' }}</td>
                                <td>{{ $asistencia->hora_salida ?? '--:--' }}</td>
                                <td><strong>{{ $horasTotal > 0 ? $horasTotal . ' hrs' : '--' }}</strong></td>
                                <td>
                                    <span class="badge badge-{{ $color }} p-2" style="width: 100px;">
                                        {{ $estado }}
                                    </span>
                                </td>
                                <td>
                                    @if(!$asistencia)
                                        <a href="{{ url('/admin/horarios/create') }}" class="btn btn-primary btn-xs"><i class="fas fa-plus"></i> Registrar</a>
                                    @else
                                        <a href="{{ url('/admin/horarios/'.$asistencia->id.'/edit') }}" class="btn btn-success btn-xs"><i class="fas fa-edit"></i></a>
                                    @endif
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