@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registrar Nuevo Movimiento de Caja</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title text-bold">Llene los datos del movimiento</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/pagos/store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Fecha</label> <b>*</b>
                                <input type="date" name="fecha" value="{{ date('Y-m-d') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Medio de Pago (Estado)</label> <b>*</b>
                                <select name="estado" id="estado_pago" class="form-control" required>
                                    <option value="EFECTIVO">EFECTIVO</option>
                                    <option value="TRANSFERENCIA">TRANSFERENCIA BANCARIA</option>
                                    <option value="CHEQUE">CHEQUE</option>
                                    <option value="PENDIENTE">PENDIENTE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tipo de Gasto/Ingreso</label> <b>*</b>
                                <select name="tipo" class="form-control" required>
                                    <option value="COMBUSTIBLE">COMBUSTIBLE</option>
                                    <option value="REPUESTOS">REPUESTOS</option>
                                    <option value="PAGO PERSONAL">PAGO PERSONAL (SUELDO)</option>
                                    <option value="PAGO PROVEEDOR">PAGO PROVEEDOR</option>
                                    <option value="ALIMENTACIÓN">ALIMENTACIÓN</option>
                                    <option value="VENTA SERVICIO">VENTA DE SERVICIO (INGRESO)</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tipo de Movimiento</label> <b>*</b>
                                <select id="tipo_movimiento" name="tipo_movimiento" class="form-control" onchange="actualizarLogica()" required>
                                    <option value="EGRESO">REGISTRAR COMO EGRESO</option>
                                    <option value="INGRESO">REGISTRAR COMO INGRESO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN DINÁMICA: SOLO PARA EGRESOS --}}
                    <div id="seccion_detalles_pago" class="card p-3 mb-3 bg-light border" style="display: block;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>¿A quién se realiza el pago?</label>
                                    <select id="destino_pago" class="form-control">
                                        <option value="OTRO">Gasto General / Otros</option>
                                        <option value="TRABAJADOR">Trabajador (Planilla)</option>
                                        <option value="PROVEEDOR">Proveedor (Factura/Boleta)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4" id="div_trabajador" style="display:none;">
                                <div class="form-group">
                                    <label>Seleccionar Trabajador</label>
                                    <select name="recurso_id" id="recurso_id" class="form-control select2">
                                        <option value="">-- Buscar --</option>
                                        @foreach($trabajadores as $t)
                                            <option value="{{ $t->id }}" data-cuenta="{{ $t->cuenta }}" data-stc="{{ $t->stc }}">
                                                {{ $t->nombres }} {{ $t->apellidos }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4" id="div_proveedor" style="display:none;">
                                <div class="form-group">
                                    <label>Seleccionar Proveedor</label>
                                    <select name="proveedor_id" id="proveedor_id" class="form-control select2">
                                        <option value="">-- Buscar --</option>
                                        @foreach($proveedores as $p)
                                            <option value="{{ $p->id }}" data-cuenta="{{ $p->nro_cuenta }}" data-banco="{{ $p->banco }}">
                                                {{ $p->razon_social }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nro. de Operación / Referencia</label>
                                    <input type="text" name="nro_operacion" class="form-control" placeholder="Opcional">
                                </div>
                            </div>
                        </div>

                        {{-- ALERTA DE INFORMACIÓN BANCARIA --}}
                        <div id="info_bancaria" class="alert alert-info mb-0" style="display:none;">
                            <strong><i class="fas fa-university"></i> Datos de Pago:</strong> 
                            <span id="detalle_banco"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Descripción</label> <b>*</b>
                                <input type="text" name="descripcion" class="form-control" placeholder="Ej: Pago de planilla mes de Octubre" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Monto (S/.)</label> <b>*</b>
                                <input type="number" step="0.01" id="monto_input" name="monto" class="form-control" placeholder="0.00" oninput="actualizarLogica()" required>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="egreso" id="egreso_hidden" value="0">
                    <input type="hidden" name="ingreso" id="ingreso_hidden" value="0">
                    <input type="hidden" name="metodo_pago" id="metodo_hidden" value="EFECTIVO">

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('admin.pagos.index') }}" class="btn btn-secondary shadow-sm">Cancelar</a>
                            <button type="submit" class="btn btn-primary shadow-sm"><i class="fas fa-save"></i> Guardar Registro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function actualizarLogica() {
        const tipoMov = document.getElementById('tipo_movimiento').value;
        const monto = document.getElementById('monto_input').value;
        const seccionEgresos = document.getElementById('seccion_detalles_pago');
        
        // Control de inputs ocultos (Tu lógica original)
        if (tipoMov === 'EGRESO') {
            document.getElementById('egreso_hidden').value = monto;
            document.getElementById('ingreso_hidden').value = 0;
            seccionEgresos.style.display = 'block';
        } else {
            document.getElementById('ingreso_hidden').value = monto;
            document.getElementById('egreso_hidden').value = 0;
            seccionEgresos.style.display = 'none';
        }

        // Sincronizar medio de pago
        document.getElementById('metodo_hidden').value = document.getElementById('estado_pago').value;
    }

    // Lógica para mostrar Trabajador o Proveedor
    document.getElementById('destino_pago').addEventListener('change', function() {
        const destino = this.value;
        document.getElementById('div_trabajador').style.display = (destino === 'TRABAJADOR') ? 'block' : 'none';
        document.getElementById('div_proveedor').style.display = (destino === 'PROVEEDOR') ? 'block' : 'none';
        document.getElementById('info_bancaria').style.display = 'none';
        
        // Limpiar selects si cambia de opción
        if(destino !== 'TRABAJADOR') document.getElementById('recurso_id').value = "";
        if(destino !== 'PROVEEDOR') document.getElementById('proveedor_id').value = "";
    });

    // Mostrar datos bancarios al seleccionar TRABAJADOR
    document.getElementById('recurso_id').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const cuenta = selected.getAttribute('data-cuenta');
        const stc = selected.getAttribute('data-stc');
        if(cuenta) {
            document.getElementById('info_bancaria').style.display = 'block';
            document.getElementById('detalle_banco').innerText = `CTA: ${cuenta} | STC: ${stc}`;
        }
    });

    // Mostrar datos bancarios al seleccionar PROVEEDOR
    document.getElementById('proveedor_id').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const cuenta = selected.getAttribute('data-cuenta');
        const banco = selected.getAttribute('data-banco');
        if(cuenta) {
            document.getElementById('info_bancaria').style.display = 'block';
            document.getElementById('detalle_banco').innerText = `BANCO: ${banco} | CTA: ${cuenta}`;
        }
    });

    // Ejecutar lógica inicial
    actualizarLogica();
</script>
@endsection