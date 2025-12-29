@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-warehouse"></i> Almacén e Inventario</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ url('/admin/almacen/create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Producto
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        {{-- SECCIÓN DE ALERTAS: Aquí es donde aparecerá el mensaje de "Stock Insuficiente" --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i> <strong>¡Atención!</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        <div class="row">
            {{-- TABLA DE EXISTENCIAS --}}
            <div class="col-md-8">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Existencias</h3>
                    </div>
                    <div class="card-body">
                        <table id="tabla_inventario" class="table table-bordered table-striped table-sm text-center">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th>Nro</th>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productos as $index => $producto)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $producto->codigo }}</td>
                                    <td class="text-left"><b>{{ $producto->nombre }}</b></td>
                                    <td class="{{ $producto->stock <= $producto->stock_minimo ? 'bg-danger text-white font-weight-bold' : '' }}">
                                        {{ $producto->stock }}
                                    </td>
                                    <td>
                                        @if($producto->stock <= $producto->stock_minimo)
                                            <span class="badge badge-warning">REABASTECER</span>
                                        @else
                                            <span class="badge badge-success">DISPONIBLE</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalMovimiento{{ $producto->id }}" title="Registrar Movimiento">
                                                <i class="fas fa-exchange-alt"></i>
                                            </button>
                                            <a href="{{ route('admin.almacen.edit', $producto->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('admin.almacen.destroy', $producto->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto?')"><i class="fas fa-trash"></i></button>
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

            {{-- HISTORIAL RECIENTE --}}
            <div class="col-md-4">
                <div class="card card-outline card-info">
                    <div class="card-header p-2">
                        <h3 class="card-title" style="font-size: 0.9rem;"><i class="fas fa-history"></i> Historial</h3>
                    </div>
                    {{-- Mantenemos el scroll para que no ocupe toda la pantalla --}}
                    <div class="card-body p-1" style="max-height: 500px; overflow-y: auto;">
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            @forelse($movimientos as $mov)
                            <li class="item p-1 mb-1" style="border-bottom: 1px solid #eee;">
                                <div class="product-info ml-1">
                                    <span class="product-title" style="font-size: 0.85rem; font-weight: bold;">
                                        {{ Str::limit($mov->almacen->nombre ?? 'Eliminado', 15) }}
                                        <span class="badge {{ $mov->tipo == 'SALIDA' ? 'badge-danger' : 'badge-success' }} float-right">
                                            {{ $mov->tipo == 'SALIDA' ? '-' : '+' }}{{ $mov->cantidad }}
                                        </span>
                                    </span>
                                    <div class="product-description" style="font-size: 0.75rem; line-height: 1.2;">
                                        <i class="fas fa-user text-xs"></i> {{ $mov->user->name ?? 'Admin' }}<br>
                                        <i class="fas fa-arrow-right text-xs"></i> {{ $mov->trabajador }}<br>
                                        {{-- FECHA Y HORA AGREGADA --}}
                                        <span class="text-muted" style="font-size: 0.7rem;">
                                            <i class="far fa-calendar-alt"></i> {{ $mov->created_at->format('d/m/Y H:i') }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                            @empty
                            <li class="item text-center p-3 text-muted">Sin movimientos.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

{{-- MODALES DE MOVIMIENTO --}}
@foreach($productos as $producto)
<div class="modal fade" id="modalMovimiento{{ $producto->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-dolly"></i> Movimiento: {{ $producto->nombre }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('movimientos.store') }}" method="POST">
                @csrf
                <input type="hidden" name="almacen_id" value="{{ $producto->id }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tipo de Operación</label>
                        <select name="tipo" class="form-control" required>
                            <option value="SALIDA">SALIDA (Descontar de stock)</option>
                            <option value="ENTRADA">ENTRADA (Aumentar stock)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trabajador Destino</label>
                        <select name="trabajador" class="form-control" required>
                            <option value="">-- Seleccione un trabajador --</option>
                            @foreach($usuarios as $u)
                                <option value="{{ $u->name }}">{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cantidad (Stock actual: {{ $producto->stock }})</label>
                        {{-- IMPORTANTE: Sin atributo "max" para que el controlador maneje el error --}}
                        <input type="number" name="cantidad" class="form-control" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Confirmar Movimiento</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('scripts')
<script>
    $(function () {
        $("#tabla_inventario").DataTable({
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": false,
            "buttons": [
                {
                    extend: 'collection',
                    text: '<i class="fas fa-file-export"></i> Reportes',
                    buttons: [
                        { extend: 'excel', text: 'Descargar Excel' },
                        { extend: 'pdf', text: 'Generar PDF' },
                        { extend: 'print', text: 'Imprimir' }
                    ]
                },
                { extend: 'colvis', text: 'Columnas' }
            ],
            "language": {
                "search": "Buscar:",
                "lengthMenu": "Mostrar _MENU_ productos",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ productos",
                "paginate": { "next": "Sig.", "previous": "Ant." }
            }
        }).buttons().container().appendTo('#tabla_inventario_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if($productosBajos->count() > 0)
            let listaProductos = "";
            @foreach($productosBajos as $p)
                listaProductos += "• {{ $p->producto }} (Stock: {{ $p->stock }})\n";
            @endforeach

            Swal.fire({
                title: '¡Atención! Stock Bajo',
                text: 'Los siguientes productos requieren reabastecimiento urgente:\n\n' + listaProductos,
                icon: 'warning',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#3085d6'
            });
        @endif
    });
</script>
@endsection