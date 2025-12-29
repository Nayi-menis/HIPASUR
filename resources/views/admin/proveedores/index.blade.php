@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>Listado de Proveedores</h1>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title text-bold">Proveedores Registrados</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.proveedores.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo Proveedor</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm table-striped">
                    <thead>
                        <tr>
                            <th>RUC</th>
                            <th>Razón Social</th>
                            <th>Banco</th>
                            <th>Cuenta</th>
                            <th>Contacto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proveedores as $prov)
                        <tr>
                            <td>{{ $prov->ruc }}</td>
                            <td>{{ $prov->razon_social }}</td>
                            <td>{{ $prov->banco }}</td>
                            <td>{{ $prov->nro_cuenta }} ({{$prov->tipo_cuenta}})</td>
                            <td>{{ $prov->contacto_nombre }} - {{ $prov->celular }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection