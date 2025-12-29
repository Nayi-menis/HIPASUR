@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-user-plus text-primary"></i> Registro de Secretaria</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary shadow-lg">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">Formulario de Alta</h3>
            </div>
            
            <div class="card-body">
                <form action="{{ url('/admin/secretarias/create') }}" method="POST" id="formSecretaria">
                    @csrf
                    
                    {{-- SECCIÓN DE VINCULACIÓN: LADO A LADO --}}
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card card-outline card-success shadow-sm h-100">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-user-check"></i> 1. Selección de Cuenta</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="user_id">Cuenta de Acceso <b>*</b></label>
                                        {{-- Este es el selector principal --}}
                                        <select name="user_id" id="user_id_principal" class="form-control" required>
                                            <option value="">-- Seleccione el correo --</option>
                                            @foreach($usuarios as $usuario)
                                                <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>
                                                    {{ $usuario->name }} ({{ $usuario->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted"><i class="fas fa-info-circle"></i> Seleccione la cuenta para ver el rol a la derecha.</small>
                                        @error('user_id')
                                            <br><small class="text-danger font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-outline card-info shadow-sm h-100">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-id-badge"></i> 2. Confirmación de Rol</h3>
                                </div>
                                <div class="card-body bg-light">
                                    <div class="form-group">
                                        <label>Rol asignado en Sistema</label>
                                        {{-- Este selector es el espejo que muestra el rol --}}
                                        <select id="user_id_espejo" class="form-control" disabled>
                                            <option value="">-- Esperando selección --</option>
                                            @foreach($usuarios as $usuario)
                                                <option value="{{ $usuario->id }}">
                                                    ROL: {{ strtoupper($usuario->role) }} ({{ $usuario->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="mt-2" id="mensaje-rol">
                                            <small class="text-muted">El rol se confirmará al elegir una cuenta.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SECCIÓN DE DATOS PERSONALES (ABAJO) --}}
                    <div class="card card-outline card-secondary bg-white shadow-sm">
                        <div class="card-header bg-light">
                            <h3 class="card-title text-secondary font-weight-bold"><i class="fas fa-address-card"></i> Datos Personales</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombres <b>*</b></label>
                                        <input type="text" value="{{ old('nombres') }}" name="nombres" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Apellidos <b>*</b></label>
                                        <input type="text" value="{{ old('apellidos') }}" name="apellidos" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>DNI <b>*</b></label>
                                        <input type="text" value="{{ old('DNI') }}" name="DNI" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Celular <b>*</b></label>
                                        <input type="text" value="{{ old('celular') }}" name="celular" class="form-control" required>
                                    </div>
                                </div>  
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fecha de nacimiento <b>*</b></label>
                                        <input type="date" value="{{ old('fecha_nacimiento') }}" name="fecha_nacimiento" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dirección <b>*</b></label>
                                        <input type="text" value="{{ old('direccion') }}" name="direccion" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 mb-3">
                        <div class="col-md-12 text-center">
                            <a href="{{ url('admin/secretarias') }}" class="btn btn-default border mr-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary shadow-sm">
                                <i class="fas fa-save"></i> Registrar Secretaria
                            </button>
                        </div>
                    </div>
                </form>   
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    {{-- SCRIPT PARA VINCULAR LOS DOS SELECTORES EN TIEMPO REAL --}}
    document.getElementById('user_id_principal').addEventListener('change', function() {
        var valorSeleccionado = this.value;
        var comboEspejo = document.getElementById('user_id_espejo');
        var mensajeRol = document.getElementById('mensaje-rol');

        // Sincroniza el segundo combo
        comboEspejo.value = valorSeleccionado;

        // Mejora visual al seleccionar
        if(valorSeleccionado !== "") {
            comboEspejo.classList.add('is-valid');
            mensajeRol.innerHTML = '<small class="text-success font-weight-bold"><i class="fas fa-check-circle"></i> Rol verificado correctamente.</small>';
        } else {
            comboEspejo.classList.remove('is-valid');
            mensajeRol.innerHTML = '<small class="text-muted">El rol se confirmará al elegir una cuenta.</small>';
        }
    });

    {{-- Por si la página recarga por error de validación, que el espejo se actualice --}}
    window.onload = function() {
        var principal = document.getElementById('user_id_principal');
        if(principal.value !== "") {
            document.getElementById('user_id_espejo').value = principal.value;
        }
    };
</script>
@endsection