@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Listado de Vehículos y Maquinaria</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Vehículos registrados</h3>
                <div class="card-tools">
                    <a href="{{url('admin/vehiculos/create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Registrar nuevo
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('mensaje'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('mensaje') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Código</th>
                            <th>Tipo</th>
                            <th>Marca / Modelo</th>
                            <th>Horómetro</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contador = 1; ?>
                        @foreach($vehiculos as $vehiculo)
                        <tr>
                            <td>{{ $contador++ }}</td>
                            <td>{{ $vehiculo->codigo_interno }}</td>
                            <td>{{ $vehiculo->tipo }}</td>
                            <td>{{ $vehiculo->marca }} - {{ $vehiculo->modelo }}</td>
                            <td>{{ $vehiculo->horometro_actual }} hrs</td>
                            <td>
                                @if($vehiculo->estado == 'OPERATIVO')
                                    <span class="badge badge-success">OPERATIVO</span>
                                @elseif($vehiculo->estado == 'MANTENIMIENTO')
                                    <span class="badge badge-warning">MANTENIMIENTO</span>
                                @else
                                    <span class="badge badge-danger">FUERA DE SERVICIO</span>
                                @endif
                            </td>
                            <td style="text-align: center">
                                <div class="btn-group" role="group">
                                    <a href="{{url('admin/vehiculos/'.$vehiculo->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                    <a href="{{url('admin/vehiculos/'.$vehiculo->id.'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                    <form action="{{url('admin/vehiculos/'.$vehiculo->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este registro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px"><i class="bi bi-trash"></i></button>
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
@endsection

@section('scripts')
<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Vehículos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Vehículos",
                "infoFiltered": "(Filtrado de _MAX_ total Vehículos)",
                "lengthMenu": "Mostrar _MENU_ Vehículos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection