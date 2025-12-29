@extends('layouts.admin')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <i class="fas fa-user-plus text-primary mr-2"></i>Expediente del Trabajador
                </h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        {{-- Mensaje General de Errores (Opcional) --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-exclamation-circle mr-2"></i> <strong>¡Atención!</strong> Hay campos con errores o datos ya registrados. Por favor, verifícalos.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{ route('admin.recursos.store') }}" method="POST" id="formRecurso">
            @csrf
            {{-- SECCIÓN SUPERIOR: CONFIGURACIÓN DE CUENTA Y TRABAJO --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-success shadow-sm h-100">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold text-success">
                                <i class="fas fa-link mr-1"></i> Vinculación de Sistema
                            </h3>
                        </div>
                        <div class="card-body">
                            <label for="user_id">Cuenta de Acceso <b>*</b></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                </div>
                                <select name="user_id" id="user_id" class="form-control custom-select @error('user_id') is-invalid @enderror" required onchange="llenarDatos()">
                                    <option value="" data-nombre="" data-apellido="" data-email="">-- Seleccione el usuario --</option>
                                    @foreach($usuarios as $usuario)
                                        @php
                                            $partes = explode(' ', $usuario->name, 2);
                                            $nombre = $partes[0];
                                            $apellido = isset($partes[1]) ? $partes[1] : '';
                                        @endphp
                                        <option value="{{ $usuario->id }}" 
                                                data-nombre="{{ $nombre }}" 
                                                data-apellido="{{ $apellido }}"
                                                data-email="{{ $usuario->email }}"
                                                {{ old('user_id') == $usuario->id ? 'selected' : '' }}
                                                @if(empty($usuario->email)) disabled @endif>
                                            {{ $usuario->name }} ({{ $usuario->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('user_id')
                                <small class="text-danger font-weight-bold">* {{ $message }}</small>
                            @enderror
                            <p class="text-muted small mt-2 mb-0">
                                <i class="fas fa-info-circle mr-1"></i> Selecciona un usuario para cargar automáticamente sus datos básicos.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-outline card-info shadow-sm h-100">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold text-info">
                                <i class="fas fa-briefcase mr-1"></i> Asignación Laboral
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cargo Actual <b>*</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                            </div>
                                            <input type="text" name="cargo" value="{{ old('cargo') }}" class="form-control @error('cargo') is-invalid @enderror" placeholder="Ej: Operador A1" required>
                                        </div>
                                        @error('cargo')<small class="text-danger font-weight-bold">* {{ $message }}</small>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Unidad Asignada <b>*</b></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-truck-pickup"></i></span>
                                            </div>
                                            <select name="vehiculo_id" class="form-control custom-select @error('vehiculo_id') is-invalid @enderror" required>
                                                <option value="">-- Seleccionar --</option>
                                                @foreach($vehiculos as $vehiculo)
                                                    <option value="{{ $vehiculo->id }}" {{ old('vehiculo_id') == $vehiculo->id ? 'selected' : '' }}>
                                                        {{ $vehiculo->codigo_interno }} ({{ $vehiculo->tipo }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('vehiculo_id')<small class="text-danger font-weight-bold">* {{ $message }}</small>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECCIÓN CENTRAL: DATOS PERSONALES --}}
            <div class="card card-outline card-primary shadow-sm mt-3">
                <div class="card-header bg-light">
                    <h3 class="card-title font-weight-bold text-primary"><i class="fas fa-id-card mr-1"></i> Información Personal y de Contacto</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombres</label>
                                <input type="text" value="{{old('nombres')}}" name="nombres" id="nombres" class="form-control border-primary @error('nombres') is-invalid @enderror" required>
                                @error('nombres')<small class="text-danger font-weight-bold">* {{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input type="text" value="{{old('apellidos')}}" name="apellidos" id="apellidos" class="form-control border-primary @error('apellidos') is-invalid @enderror" required>
                                @error('apellidos')<small class="text-danger font-weight-bold">* {{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>DNI / Documento</label>
                                <input type="text" value="{{old('DNI')}}" name="DNI" class="form-control @error('DNI') is-invalid @enderror" required>
                                @error('DNI')<small class="text-danger font-weight-bold">* {{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><i class="fas fa-phone mr-1"></i> Celular</label>
                                <input type="text" value="{{old('celular')}}" name="celular" class="form-control @error('celular') is-invalid @enderror" required>
                                @error('celular')<small class="text-danger font-weight-bold">* {{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><i class="fas fa-envelope mr-1"></i> Email</label>
                                <input type="email" value="{{old('email')}}" name="email" id="email" class="form-control bg-light @error('email') is-invalid @enderror" readonly required>
                                @error('email')<small class="text-danger font-weight-bold">* {{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><i class="fas fa-calendar-alt mr-1"></i> F. Nacimiento</label>
                                <input type="date" value="{{old('fecha_nacimiento')}}" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror" required>
                                @error('fecha_nacimiento')<small class="text-danger font-weight-bold">* {{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Edad</label>
                                <input type="number" value="{{old('edad')}}" name="edad" class="form-control @error('edad') is-invalid @enderror" required>
                                @error('edad')<small class="text-danger font-weight-bold">* {{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    <h5 class="text-secondary mb-3"><i class="fas fa-university mr-1"></i> Información Bancaria y Ubicación</h5>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cuenta ICC</label>
                                <input type="text" value="{{old('cuenta')}}" name="cuenta" class="form-control @error('cuenta') is-invalid @enderror" placeholder="000-0000000" required>
                                @error('cuenta')<small class="text-danger font-weight-bold">* {{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cuenta STC</label>
                                <input type="text" value="{{old('stc')}}" name="stc" class="form-control @error('stc') is-invalid @enderror" placeholder="STC-XXXX" required>
                                @error('stc')<small class="text-danger font-weight-bold">* {{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Departamento</label>
                                <input type="text" value="{{old('departamento')}}" name="departamento" class="form-control @error('departamento') is-invalid @enderror" required>
                                @error('departamento')<small class="text-danger font-weight-bold">* {{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Provincia</label>
                                <input type="text" value="{{old('provincia')}}" name="provincia" class="form-control @error('provincia') is-invalid @enderror" required>
                                @error('provincia')<small class="text-danger font-weight-bold">* {{ $message }}</small>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white border-top-0">
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="{{url('admin/recursos')}}" class="btn btn-outline-secondary px-4 mr-2">
                                <i class="fas fa-times mr-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary px-5 shadow">
                                <i class="fas fa-save mr-1"></i> Registrar y Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>   
    </div>
</div>

<script>
function llenarDatos() {
    var select = document.getElementById('user_id');
    var selectedOption = select.options[select.selectedIndex];
    document.getElementById('nombres').value = selectedOption.getAttribute('data-nombre') || '';
    document.getElementById('apellidos').value = selectedOption.getAttribute('data-apellido') || '';
    document.getElementById('email').value = selectedOption.getAttribute('data-email') || '';
}

// Validación extra para evitar submit sin email
const form = document.getElementById('formRecurso');
form.addEventListener('submit', function(e) {
    const email = document.getElementById('email').value;
    if (!email) {
        alert('Debe seleccionar un usuario con email válido.');
        e.preventDefault();
    }
});
</script>

@endsection