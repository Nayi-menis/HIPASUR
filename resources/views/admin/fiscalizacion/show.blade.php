@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detalle de la Fiscalización</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Información de la Inspección / Auditoría</h3>
                <div class="card-tools">
                    <button onclick="window.print();" class="btn btn-default btn-sm">
                        <i class="fas fa-print"></i> Imprimir Reporte
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Fecha de Visita:</label>
                        <p class="form-control-static text-muted">{{ \Carbon\Carbon::parse($fiscalizacion->fecha)->format('d/m/Y') }}</p>
                    </div>
                    <div class="col-md-4">
                        <label>Entidad Fiscalizadora:</label>
                        <p class="form-control-static text-muted">{{ $fiscalizacion->entidad }}</p>
                    </div>
                    <div class="col-md-4">
                        <label>Inspector a Cargo:</label>
                        <p class="form-control-static text-muted">{{ $fiscalizacion->inspector }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label>Motivo:</label>
                        <p class="form-control-static text-muted">{{ $fiscalizacion->motivo }}</p>
                    </div>
                    <div class="col-md-6">
                        <label>Resultado de la Fiscalización:</label><br>
                        @if($fiscalizacion->resultado == 'APROBADO')
                            <span class="badge badge-success">APROBADO</span>
                        @elseif($fiscalizacion->resultado == 'CON OBSERVACIONES')
                            <span class="badge badge-warning">CON OBSERVACIONES</span>
                        @else
                            <span class="badge badge-danger">MULTA / SANCIÓN</span>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label>Observaciones del Inspector:</label>
                        <div class="p-3 bg-light border rounded">
                            {{ $fiscalizacion->observaciones ?? 'Sin observaciones registradas.' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Medidas Adoptadas / Plan de Acción:</label>
                        <div class="p-3 bg-light border rounded">
                            {{ $fiscalizacion->medidas_adoptadas ?? 'No se han registrado medidas correctivas aún.' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{url('admin/fiscalizacion') }}" class="btn btn-secondary">Volver al Listado</a>
                <a href="{{url('admin/fiscalizacion', $fiscalizacion->id . '/edit') }}" class="btn btn-success">
                    <i class="fas fa-edit"></i> Editar Registro
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .btn, .card-footer, .main-footer, .content-header {
            display: none !important;
        }
        .card-outline {
            border-top: none !important;
        }
    }
</style>
@endsection