@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detalle del Reporte de Seguridad</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Información Registrada</h3>
                <div class="card-tools">
                    <button onclick="window.print();" class="btn btn-default btn-sm">
                        <i class="fas fa-print"></i> Imprimir
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Fecha:</label>
                        <p class="form-control-static text-muted">{{ \Carbon\Carbon::parse($seguridad->fecha)->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-4">
                        <label>Tipo de Registro:</label>
                        <p class="form-control-static text-muted">{{ $seguridad->tipo_registro }}</p>
                    </div>
                    <div class="col-md-4">
                        <label>Área:</label>
                        <p class="form-control-static text-muted">{{ $seguridad->area }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label>Responsable:</label>
                        <p class="form-control-static text-muted">{{ $seguridad->responsable }}</p>
                    </div>
                    <div class="col-md-6">
                        <label>Nivel de Riesgo:</label><br>
                        @if($seguridad->nivel_riesgo == 'BAJO')
                            <span class="badge badge-success">BAJO</span>
                        @elseif($seguridad->nivel_riesgo == 'MEDIO')
                            <span class="badge badge-warning">MEDIO</span>
                        @elseif($seguridad->nivel_riesgo == 'ALTO')
                            <span class="badge badge-orange" style="background-color: #fd7e14; color: white;">ALTO</span>
                        @else
                            <span class="badge badge-danger">CRÍTICO</span>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label>Descripción / Hallazgo:</label>
                        <div class="p-3 bg-light border rounded">
                            {{ $seguridad->descripcion }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Acción Correctiva:</label>
                        <div class="p-3 bg-light border rounded">
                            {{ $seguridad->accion_correctiva ?? 'No se registraron acciones adicionales.' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.seguridad.index') }}" class="btn btn-secondary">Volver al Listado</a>
            </div>
        </div>
    </div>
</div>
@endsection