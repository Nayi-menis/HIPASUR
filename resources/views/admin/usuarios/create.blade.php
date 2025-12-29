@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-user-shield text-primary"></i> Registro de un nuevo usuario</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-primary shadow-lg">
            <div class="card-header bg-light">
                <h3 class="card-title font-weight-bold">Completar los datos de acceso</h3>
            </div>
            
            <div class="card-body">
                <form action="{{ url('/admin/usuarios/store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        {{-- COLUMNA IZQUIERDA: IDENTIDAD --}}
                        <div class="col-md-6 border-right">
                            <h5 class="text-primary mb-3"><i class="fas fa-id-card"></i> Información Personal</h5>
                            
                            <div class="form-group">
                                <label for="name">Nombre del Usuario <b>*</b></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
                                    <input type="text" value="{{ old('name') }}" name="name" class="form-control" placeholder="Nombre completo" required>
                                </div>
                                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email (Correo Electrónico) <b>*</b></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
                                    <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="ejemplo@correo.com" required>
                                </div>
                                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            <div class="form-group">
                                <label for="role">Rol del Usuario</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user-tag"></i></span></div>
                                    <select name="role" class="form-control select2">
                                        <option value="administrador">Administrador (Acceso Total)</option>
                                        <option value="secretaria">Secretaria / Recepción</option>
                                        <option value="encargado">Encargado de campo</option>
                                        <option value="personal">Trabajador</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- COLUMNA DERECHA: SEGURIDAD --}}
                        <div class="col-md-6">
                            <div class="pl-md-3">
                                <h5 class="text-success mb-3"><i class="fas fa-lock"></i> Seguridad de la Cuenta</h5>
                                
                                <div class="form-group">
                                    <label for="password">Contraseña <b>*</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-key"></i></span></div>
                                        <input type="password" name="password" class="form-control" placeholder="Mínimo 8 caracteres" required>
                                    </div>
                                    @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Repita su contraseña <b>*</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-check-double"></i></span></div>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña" required>
                                    </div>
                                </div>

                                <div class="alert alert-info mt-4">
                                    <h5><i class="icon fas fa-info"></i> Ayuda</h5>
                                    <small>Asegúrese de usar una contraseña segura que incluya letras, números y símbolos para proteger la cuenta.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12 text-center p-3">
                            <a href="{{ url('admin/usuarios') }}" class="btn btn-default btn-lg border mr-3">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg shadow">
                                <i class="fas fa-save"></i> Registrar Usuario
                            </button>
                        </div>
                    </div>
                </form>   
            </div>
        </div>
    </div>
</div>
@endsection