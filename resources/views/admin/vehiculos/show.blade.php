@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detalles de la Unidad: {{ $vehiculo->codigo_interno }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ url('admin/vehiculos') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver al listado
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <i class="fas fa-truck-moving fa-5x text-primary mb-3"></i>
                        </div>
                        <h3 class="profile-username text-center">{{ $vehiculo->tipo }}</h3>
                        <p class="text-muted text-center">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Estado Actual</b> 
                                <span class="float-right">
                                    @if($vehiculo->estado == 'OPERATIVO')
                                        <span class="badge badge-success">{{ $vehiculo->estado }}</span>
                                    @elseif($vehiculo->estado == 'EN MANTENIMIENTO')
                                        <span class="badge badge-warning">{{ $vehiculo->estado }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $vehiculo->estado }}</span>
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item">
                                <b>Placa / Registro</b> <span class="float-right">{{ $vehiculo->placa ?? 'SIN PLACA' }}</span>
                            </li>
                        </ul>
                        <a href="{{ url('admin/vehiculos/' . $vehiculo->id . '/edit') }}" class="btn btn-success btn-block"><b>Editar Información</b></a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-2">
                        <h3 class="card-title p-2">Especificaciones Técnicas</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <strong><i class="fas fa-barcode mr-1"></i> Código Interno</strong>
                                <p class="text-muted">{{ $vehiculo->codigo_interno }}</p>
                                <hr>
                                <strong><i class="fas fa-cogs mr-1"></i> Serie de Motor / Chasis</strong>
                                <p class="text-muted">{{ $vehiculo->serie_motor ?? 'No registrado' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <strong><i class="far fa-calendar-alt mr-1"></i> Fecha de Registro</strong>
                                <p class="text-muted">{{ $vehiculo->created_at->format('d/m/Y H:i') }}</p>
                                <hr>
                                <strong><i class="fas fa-info-circle mr-1"></i> Última Actualización</strong>
                                <p class="text-muted">{{ $vehiculo->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <strong><i class="fas fa-file-alt mr-1"></i> Descripción / Notas</strong>
                                <p class="text-muted">{{ $vehiculo->descripcion ?? 'Sin observaciones adicionales.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection