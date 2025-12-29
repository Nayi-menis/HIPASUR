@extends('layouts.app')

@section('content')
<style>
    .personal-portal {
        background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), 
                    url('{{ asset('dist/img/fondo-minero.jpg') }}'); /* Tu imagen de maquinaria */
        background-size: cover;
        background-position: center;
        height: calc(100vh - 56px); /* Ajuste para que no sobre espacio abajo */
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }
    .portal-content {
        background: rgba(0, 0, 0, 0.6);
        padding: 40px;
        border-radius: 15px;
        border: 2px solid #ffc107;
        backdrop-filter: blur(5px);
    }
</style>

<div class="personal-portal">
    <div class="portal-content shadow-lg">
        <h1 class="display-4 font-weight-bold">PANEL OPERATIVO</h1>
        <h3 class="text-warning text-uppercase">{{ Auth::user()->name }}</h3>
        <hr class="border-warning">
        <p class="lead">Bienvenido al sistema de gestión de <b>HIPASUR.SAC</b></p>
        
        <div class="mt-4">
            <a href="{{ route('admin.produccion.index') }}" class="btn btn-warning btn-lg px-5 font-weight-bold">
                <i class="fas fa-hard-hat mr-2"></i> REGISTRAR PRODUCCIÓN
            </a>
        </div>
    </div>
</div>
@endsection