@extends('layouts.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Registro de un nuevo vehículo</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-header-title">Llene los datos con cuidado</h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin/vehiculos/create')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Código Interno</label> <b>*</b>
                                <input type="text" name="codigo_interno" value="{{old('codigo_interno')}}" class="form-control" placeholder="Ej: EXC-001" required>
                                @error('codigo_interno')
                                <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tipo de Unidad</label> <b>*</b>
                                <select name="tipo" class="form-control" required>
                                    <option value="">Seleccione un tipo...</option>
                                    <option value="EXCAVADORA">EXCAVADORA</option>
                                    <option value="VOLQUETE">VOLQUETE</option>
                                    <option value="CAMIONETA">CAMIONETA</option>
                                    <option value="CARGADOR FRONTAL">CARGADOR FRONTAL</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Placa</label>
                                <input type="text" name="placa" value="{{old('placa')}}" class="form-control" placeholder="Opcional">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Marca</label> <b>*</b>
                                <input type="text" name="marca" value="{{old('marca')}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Modelo</label> <b>*</b>
                                <input type="text" name="modelo" value="{{old('modelo')}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Horómetro Inicial</label> <b>*</b>
                                <input type="number" step="0.01" name="horometro_actual" value="{{old('horometro_actual', 0)}}" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Estado</label>
                                <select name="estado" class="form-control">
                                    <option value="OPERATIVO">OPERATIVO</option>
                                    <option value="MANTENIMIENTO">MANTENIMIENTO</option>
                                    <option value="FUERA_SERVICIO">FUERA DE SERVICIO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Observaciones</label>
                                <textarea name="observaciones" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('admin/vehiculos') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Registrar Vehículo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection