@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Modificar Registro: {{ $pago->descripcion }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-11">
                    <div class="card card-outline card-success shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">Actualice los datos y el tipo de movimiento</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.pagos.update', $pago->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Fecha</label> <b>*</b>
                                            <input type="date" name="fecha" value="{{ $pago->fecha->format('Y-m-d') }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Estado</label> <b>*</b>
                                            <select name="estado" class="form-control" required>
                                                <option value="EFECTIVO" {{ $pago->estado == 'EFECTIVO' ? 'selected' : '' }}>EFECTIVO</option>
                                                <option value="TRANSFERENCIA" {{ $pago->estado == 'TRANSFERENCIA' ? 'selected' : '' }}>TRANSFERENCIA</option>
                                                <option value="CHEQUE" {{ $pago->estado == 'CHEQUE' ? 'selected' : '' }}>CHEQUE</option>
                                                <option value="PENDIENTE" {{ $pago->estado == 'PENDIENTE' ? 'selected' : '' }}>PENDIENTE</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Concepto</label> <b>*</b>
                                            <select name="tipo" class="form-control" required>
                                                <option value="COMBUSTIBLE" {{ $pago->tipo == 'COMBUSTIBLE' ? 'selected' : '' }}>COMBUSTIBLE</option>
                                                <option value="REPUESTOS" {{ $pago->tipo == 'REPUESTOS' ? 'selected' : '' }}>REPUESTOS</option>
                                                <option value="PAGO PERSONAL" {{ $pago->tipo == 'PAGO PERSONAL' ? 'selected' : '' }}>PAGO PERSONAL</option>
                                                <option value="ALIMENTACIÓN" {{ $pago->tipo == 'ALIMENTACIÓN' ? 'selected' : '' }}>ALIMENTACIÓN</option>
                                                <option value="VENTA SERVICIO" {{ $pago->tipo == 'VENTA SERVICIO' ? 'selected' : '' }}>VENTA DE SERVICIO</option>
                                                <option value="OTROS" {{ $pago->tipo == 'OTROS' ? 'selected' : '' }}>OTROS</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- NUEVO: Selector de Tipo de Movimiento para permitir el cambio --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tipo de Movimiento</label> <b>*</b>
                                            <select id="tipo_movimiento" name="tipo_movimiento" class="form-control" onchange="recalcularBalance()" required>
                                                <option value="EGRESO" {{ $pago->egreso > 0 ? 'selected' : '' }}>REGISTRAR COMO EGRESO</option>
                                                <option value="INGRESO" {{ $pago->ingreso > 0 ? 'selected' : '' }}>REGISTRAR COMO INGRESO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Descripción</label> <b>*</b>
                                            <input type="text" name="descripcion" value="{{ $pago->descripcion }}" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Monto (S/.)</label> <b>*</b>
                                            <input type="number" step="0.01" name="monto" id="monto_input" value="{{ $pago->monto }}" class="form-control" oninput="recalcularBalance()" required>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="egreso" id="egreso_hidden" value="{{ $pago->egreso }}">
                                <input type="hidden" name="ingreso" id="ingreso_hidden" value="{{ $pago->ingreso }}">

                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('admin.pagos.index') }}" class="btn btn-secondary">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Actualizar Registro</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function recalcularBalance() {
        let monto = document.getElementById('monto_input').value;
        let movimiento = document.getElementById('tipo_movimiento').value;
        
        if (movimiento === 'INGRESO') {
            document.getElementById('ingreso_hidden').value = monto;
            document.getElementById('egreso_hidden').value = 0;
        } else {
            document.getElementById('egreso_hidden').value = monto;
            document.getElementById('ingreso_hidden').value = 0;
        }
    }
</script>
@endsection