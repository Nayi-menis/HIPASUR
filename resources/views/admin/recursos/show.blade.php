@extends('layouts.admin')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-id-card-alt text-primary mr-2"></i>Expediente del Trabajador
                </h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ url('admin/recursos') }}" class="btn btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left"></i> Volver al listado
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            {{-- COLUMNA IZQUIERDA: RESUMEN DE PERFIL --}}
            <div class="col-md-4">
                <div class="card card-primary card-outline shadow">
                    <div class="card-body box-profile">
                        <div class="text-center mb-3">
                            <i class="fas fa-user-circle fa-6x text-secondary"></i>
                        </div>
                        <h3 class="profile-username text-center font-weight-bold">{{ $recurso->nombres }} {{ $recurso->apellidos }}</h3>
                        <p class="text-muted text-center"><span class="badge badge-info px-3 py-2">{{ $recurso->cargo }}</span></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b><i class="fas fa-fingerprint mr-1"></i> DNI</b> 
                                <span class="float-right text-dark font-weight-bold">{{ $recurso->DNI }}</span>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fas fa-truck-pickup mr-1"></i> Unidad Asignada</b> 
                                <span class="float-right text-primary font-weight-bold">
                                    {{ $recurso->vehiculo->codigo_interno ?? 'Sin Vehículo' }}
                                </span>
                            </li>
                            <li class="list-group-item">
                                <b><i class="fas fa-birthday-cake mr-1"></i> Edad</b> 
                                <span class="float-right">{{ $recurso->edad }} años</span>
                            </li>
                        </ul>

                        <a href="{{ url('admin/recursos/'.$recurso->id.'/edit') }}" class="btn btn-success btn-block shadow">
                            <i class="fas fa-edit"></i> <b>Editar Datos del Trabajador</b>
                        </a>
                    </div>
                </div>

                {{-- INFORMACIÓN DE UBICACIÓN --}}
                <div class="card card-primary shadow mt-3">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold"><i class="fas fa-map-marker-alt mr-1"></i> Residencia</h3>
                    </div>
                    <div class="card-body">
                        <strong><i class="fas fa-map mr-1"></i> Departamento</strong>
                        <p class="text-muted">{{ $recurso->departamento }}</p>
                        <hr>
                        <strong><i class="fas fa-city mr-1"></i> Provincia</strong>
                        <p class="text-muted">{{ $recurso->provincia }}</p>
                    </div>
                </div>
            </div>

            {{-- COLUMNA DERECHA: DATOS DETALLADOS --}}
            <div class="col-md-8">
                <div class="card card-outline card-info shadow">
                    <div class="card-header bg-white">
                        <h3 class="card-title font-weight-bold text-info">
                            <i class="fas fa-info-circle mr-1"></i> Información Completa
                        </h3>
                    </div>
                    <div class="card-body">
                        <h5 class="text-muted border-bottom pb-2"><i class="fas fa-address-book mr-1"></i> Contacto y Personal</h5>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label><i class="fas fa-envelope mr-1"></i> Correo Electrónico</label>
                                <p class="form-control bg-light border-0 shadow-sm">{{ $recurso->user->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><i class="fas fa-phone mr-1"></i> Celular</label>
                                <p class="form-control bg-light border-0 shadow-sm">{{ $recurso->celular }}</p>
                            </div>
                            <div class="col-md-6">
                                <label><i class="fas fa-calendar-alt mr-1"></i> Fecha de Nacimiento</label>
                                <p class="form-control bg-light border-0 shadow-sm">
                                    {{ \Carbon\Carbon::parse($recurso->fecha_nacimiento)->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label><i class="fas fa-user-tag mr-1"></i> Cargo Laboral</label>
                                <p class="form-control bg-light border-0 shadow-sm font-weight-bold text-info">{{ $recurso->cargo }}</p>
                            </div>
                        </div>

                        <h5 class="text-muted border-bottom pb-2 mt-4"><i class="fas fa-university mr-1"></i> Cuentas Bancarias</h5>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="info-box bg-light shadow-sm">
                                    <span class="info-box-icon bg-secondary"><i class="fas fa-piggy-bank"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Cuenta ICC</span>
                                        <span class="info-box-number text-dark font-weight-bold">{{ $recurso->cuenta }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box bg-light shadow-sm">
                                    <span class="info-box-icon bg-secondary text-white"><i class="fas fa-wallet"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Cuenta STC</span>
                                        <span class="info-box-number text-dark font-weight-bold">{{ $recurso->stc }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="text-muted border-bottom pb-2 mt-4"><i class="fas fa-truck mr-1"></i> Asignación de Recursos</h5>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="alert alert-info border-0 shadow-sm">
                                    <h6 class="font-weight-bold"><i class="fas fa-link mr-2"></i> Unidad Operativa Actual:</h6>
                                    @if($recurso->vehiculo)
                                        <p class="mb-0 ml-4">
                                            <strong>Código:</strong> {{ $recurso->vehiculo->codigo_interno }} <br>
                                            <strong>Tipo:</strong> {{ $recurso->vehiculo->tipo }}
                                        </p>
                                    @else
                                        <p class="mb-0 ml-4">No tiene una unidad asignada actualmente.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection