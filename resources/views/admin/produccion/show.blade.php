@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detalle de Producción</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Información Registrada</h3>
                        <div class="card-tools">
                            <a href="{{ url('/admin/produccion') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="bg-light" style="width: 40%;">Trabajador Responsable</th>
                                        <td>{{ $produccion->recurso->nombres }} {{ $produccion->recurso->apellidos }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Fecha de Registro</th>
                                        <td>{{ \Carbon\Carbon::parse($produccion->fecha)->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Zona de Extracción</th>
                                        <td>{{ $produccion->zona }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="bg-light" style="width: 40%;">Tipo de Mineral</th>
                                        <td><span class="badge badge-info">{{ $produccion->tipo_mineral }}</span></td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Cantidad Extraída</th>
                                        <td><strong>{{ number_format($produccion->cantidad, 2) }} Toneladas</strong></td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Última Actualización</th>
                                        <td>{{ $produccion->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-info"></i> Observaciones Técnicas:</h5>
                                    <p>{{ $produccion->observaciones ?? 'Sin observaciones registradas para esta jornada.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('/admin/produccion/'.$produccion->id.'/edit') }}" class="btn btn-success">
                            <i class="fas fa-edit"></i> Editar Datos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection