@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Listado de Producción Minera</h1>
            </div>
            <div class="col-sm-6">
                <a href="{{ url('/admin/produccion/create') }}" class="btn btn-primary float-right">
                    <i class="fas fa-plus"></i> Registrar Producción
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Historial de Extracción Diario</h3>
            </div>
            <div class="card-body">
                <table id="tabla_produccion" class="table table-bordered table-striped table-sm text-center">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th>Nro</th>
                            <th>Fecha</th>
                            <th>Trabajador</th>
                            <th>Zona / Veta</th>
                            <th>Mineral</th>
                            <th>Cantidad (Tn)</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($producciones as $index => $produccion)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($produccion->fecha)->format('d/m/Y') }}</td>
                            <td class="text-left">{{ $produccion->recurso->nombres }} {{ $produccion->recurso->apellidos }}</td>
                            <td>{{ $produccion->zona }}</td>
                            <td>
                                <span class="badge badge-info">{{ $produccion->tipo_mineral }}</span>
                            </td>
                            <td><strong>{{ number_format($produccion->cantidad, 2) }}</strong></td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ url('/admin/produccion/'.$produccion->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ url('/admin/produccion/'.$produccion->id.'/edit') }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-{{ $produccion->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <div class="modal fade" id="modal-delete-{{ $produccion->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-left">
                                            <div class="modal-header bg-danger">
                                                <h4 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Confirmar Eliminación</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>¿Realmente desea eliminar el registro de producción en <b>{{ $produccion->zona }}</b>?</p>
                                                <p>Detalles del registro:</p>
                                                <ul>
                                                    <li><b>Trabajador:</b> {{ $produccion->recurso->nombres }}</li>
                                                    <li><b>Cantidad:</b> {{ number_format($produccion->cantidad, 2) }} Tn</li>
                                                </ul>
                                                <p class="text-danger"><small>Esta acción no se puede deshacer.</small></p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <form action="{{ url('/admin/produccion/'.$produccion->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Eliminar Definitivamente</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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

@section('scripts')
<script>
    $(function () {
        $("#tabla_produccion").DataTable({
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