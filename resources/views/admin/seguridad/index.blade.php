@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Listado de Seguridad y Salud (SST)</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{url('admin/seguridad/create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Reporte
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Historial de Incidentes e Inspecciones</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Fecha</th>
                            <th>Tipo de Registro</th>
                            <th>Área</th>
                            <th>Responsable</th>
                            <th>Nivel de Riesgo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp
                        @foreach($registros as $registro)
                        <tr>
                            <td>{{ $contador++ }}</td>
                            <td>{{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}</td>
                            <td>{{ $registro->tipo_registro }}</td>
                            <td>{{ $registro->area }}</td>
                            <td>{{ $registro->responsable }}</td>
                            <td class="text-center">
                                @if($registro->nivel_riesgo == 'BAJO')
                                    <span class="badge badge-success">BAJO</span>
                                @elseif($registro->nivel_riesgo == 'MEDIO')
                                    <span class="badge badge-warning">MEDIO</span>
                                @elseif($registro->nivel_riesgo == 'ALTO')
                                    <span class="badge badge-orange" style="background-color: #fd7e14; color: white;">ALTO</span>
                                @else
                                    <span class="badge badge-danger">CRÍTICO</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.seguridad.show', $registro->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.seguridad.edit', $registro->id) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.seguridad.destroy', $registro->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este reporte?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });
    });
</script>
@endsection