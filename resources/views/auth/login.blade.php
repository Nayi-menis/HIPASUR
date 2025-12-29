@extends('layouts.app')

@section('content')
<style>
    /* Fondo con imagen de minería y overlay oscuro */
    .login-page-custom {
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), 
                    url('{{ asset('dist/img/fondo-minero1.jpg') }}'); /* Asegúrate que la imagen esté en esta ruta */
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Tarjeta Elegante */
    .login-box-custom {
        width: 400px;
    }

    .card-custom {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        border-top: 5px solid #ffc107; /* Color dorado minero */
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .btn-minero {
        background-color: #003366; /* Azul corporativo oscuro */
        border: none;
        color: white;
        transition: 0.3s;
    }

    .btn-minero:hover {
        background-color: #002244;
        transform: translateY(-2px);
        color: #ffc107;
    }

    .role-icon {
        font-size: 1.5rem;
        margin-bottom: 5px;
        color: #666;
    }
</style>

<div class="login-page-custom">
    <div class="login-box-custom">
        <div class="card card-custom">
            <div class="card-header text-center border-0 pt-4">
                <h1 class="h1 mb-0" style="color: #003366;"><b>HIPASUR</b>.SAC</h1>
                <p class="text-uppercase tracking-widest small font-weight-bold text-muted">Sistema de Gestión Minera</p>
            </div>
            
            <div class="card-body login-card-body p-4">
                
                <p class="login-box-msg text-dark">Ingrese sus credenciales para continuar</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo Electrónico" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text bg-white border-left-0">
                                <span class="fas fa-envelope text-muted"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="input-group mb-4">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text bg-white border-left-0">
                                <span class="fas fa-lock text-muted"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="row align-items-center">
                        <div class="col-7">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                <label class="custom-control-label small text-muted" for="remember">Mantener sesión</label>
                            </div>
                        </div>
                        <div class="col-5">
                            <button type="submit" class="btn btn-minero btn-block font-weight-bold shadow-sm">
                                ENTRAR <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="mb-0 small">
                        <a href="{{ route('password.request') }}" class="text-muted">¿Olvidó su contraseña?</a>
                    </p>
                </div>
            </div>
        </div>
        <p class="text-center text-white-50 mt-3 small">&copy; 2025 HIPASUR.SAC - Operaciones Seguras</p>
    </div>
</div>
@endsection