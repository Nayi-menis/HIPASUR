@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1>Eliminar Registro Contable</h1>
    </div>
</div>

<div class="container-fluid">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">¿Está seguro de eliminar este registro?</h3>
        </div>
        <div class="card-body">
            <form action="{{url('admin/pagos/destroy', $pago->id) }}" method="POST">
                @csrf
                @method('DELETE')
                
                <div class="row">
                    <div class="col-md-6">
                        <label>Descripción</label>
                        <input type="text" value="{{ $pago->descripcion }}" class="form-control" disabled>
                    </div>
                    <div class="col-md-6">
                        <label>Monto</label>
                        <input type="text" value="S/. {{ $pago->monto }}" class="form-control" disabled>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{url('admin/pagos/index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-danger">Eliminar Definitivamente</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection