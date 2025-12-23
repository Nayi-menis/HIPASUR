@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-warehouse"></i> Inventario de Almacén</h1>
            </div>
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="{{ url('/admin/almacen/create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nuevo Producto
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Existencias (Víveres, Herramientas, Combustible)</h3>
                    </div>
                    <div class="card-body">
                        <table id="tabla_inventario" class="table table-bordered table-striped table-sm text-center">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th>Nro</th>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Categoría</th>
                                    <th>Stock Actual</th>
                                    <th>Stock Mínimo</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productos as $index => $producto)
                                @php
                                    // Definir si el stock está bajo
                                    $stockBajo = $producto->stock <= $producto->stock_minimo;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $producto->codigo }}</td>
                                    <td class="text-left">{{ $producto->nombre }}</td>
                                    <td><span class="badge badge-info">{{ $producto->categoria }}</span></td>
                                    
                                    <td class="{{ $stockBajo ? 'bg-danger text-white font-weight-bold' : '' }}">
                                        {{ $producto->stock }} {{ $producto->unidad_medida }}
                                    </td>
                                    
                                    <td>{{ $producto->stock_minimo }}</td>
                                    
                                    <td>
                                        @if($stockBajo)
                                            <span class="badge badge-warning">
                                                <i class="fas fa-exclamation-triangle"></i> REABASTECER
                                            </span>
                                        @else
                                            <span class="badge badge-success">DISPONIBLE</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.almacen.show', $producto->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.almacen.edit', $producto->id) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete-{{ $producto->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <div class="modal fade" id="modal-delete-{{ $producto->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content text-left">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h4 class="modal-title">Confirmar Eliminación</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Está seguro de eliminar el producto <b>{{ $producto->nombre }}</b>?</p>
                                                        <p>Esta acción no se puede deshacer y el registro desaparecerá del inventario.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        <form action="{{ route('admin.almacen.destroy', $producto->id) }}" method="POST">
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
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
        $("#tabla_inventario").DataTable({
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": false,
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar Producto:",
                "zeroRecords": "No se encontraron resultados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
</script>
@endsection