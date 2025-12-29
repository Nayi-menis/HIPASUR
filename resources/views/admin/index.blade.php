@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Panel Principal - {{ ucfirst(Auth::user()->role) }}</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">

            @if(Auth::user()->role == 'administrador')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $total_usuarios }}</h3>
                        <p>Usuarios Registrados</p>
                    </div>
                    <div class="icon"><i class="bi bi-people"></i></div>
                    <a href="{{ url('admin/usuarios') }}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>S/ {{ number_format($total_finanzas, 2) }}</h3>
                        <p>Total Ingresos</p>
                    </div>
                    <div class="icon"><i class="bi bi-cash-stack"></i></div>
                    <a href="{{ url('admin/pagos') }}" class="small-box-footer">Ver finanzas <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endif

            @if(in_array(Auth::user()->role, ['administrador', 'secretaria']))
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>15</h3> <p>Alertas de Seguridad</p>
                    </div>
                    <div class="icon"><i class="bi bi-exclamation-triangle"></i></div>
                    <a href="{{ url('admin/seguridad') }}" class="small-box-footer">Ver alertas <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endif

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ Auth::user()->role == 'personal' ? $mi_produccion : 'Global' }}</h3>
                        <p>Producción Reportada</p>
                    </div>
                    <div class="icon"><i class="bi bi-minecart-loaded"></i></div>
                    <a href="{{ url('admin/produccion') }}" class="small-box-footer">Mis registros <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Bienvenido al Sistema HIPASUR, {{ Auth::user()->name }}</h3>
                    </div>
                    <div class="card-body">
                        <p>Usted ha ingresado con el rol de <b>{{ strtoupper(Auth::user()->role) }}</b>. 
                        Utilice el menú lateral para navegar por los módulos de la empresa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection