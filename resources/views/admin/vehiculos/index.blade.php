@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Listado de Vehículos y Maquinaria</h1>
            </div>
            <div class="col-sm-6">
                <div class="float-sm-right">
                    <a href="{{ url('admin/vehiculos/create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Registrar Nuevo
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
                        <h3 class="card-title">Maquinaria Registrada</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Tipo</th>
                                    <th>Marca / Modelo</th>
                                    <th>Placa</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $vehiculo->codigo_interno }}</td>
                                    <td>{{ $vehiculo->tipo }}</td>
                                    <td>{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</td>
                                    <td>{{ $vehiculo->placa ?? 'N/A' }}</td>
                                    <td>
                                        @if($vehiculo->estado == 'OPERATIVO')
                                            <span class="badge badge-success">{{ $vehiculo->estado }}</span>
                                        @elseif($vehiculo->estado == 'EN MANTENIMIENTO')
                                            <span class="badge badge-warning">{{ $vehiculo->estado }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $vehiculo->estado }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ url('admin/vehiculos/' . $vehiculo->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ url('admin/vehiculos/' . $vehiculo->id . '/edit') }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{ url('admin/vehiculos/' . $vehiculo->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta unidad?')">
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
    </div>
</div>
@endsection