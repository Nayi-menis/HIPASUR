@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>Registrar Nuevo Proveedor</h1>
</div>
<hr>
<div class="row">
    <div class="col-md-9">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title text-bold">Complete los datos del proveedor</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.proveedores.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>RUC</label> <b>*</b>
                                <input type="text" name="ruc" value="{{old('ruc')}}" class="form-control" required>
                                @error('ruc') <small class="text-danger">{{$message}}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Razón Social</label> <b>*</b>
                                <input type="text" name="razon_social" value="{{old('razon_social')}}" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Banco</label> <b>*</b>
                                <select name="banco" class="form-control" required>
                                    <option value="">-- Seleccione --</option>
                                    <option value="BCP">BCP</option>
                                    <option value="BBVA">BBVA</option>
                                    <option value="INTERBANK">INTERBANK</option>
                                    <option value="BANCO DE LA NACIÓN">BANCO DE LA NACIÓN</option>
                                    <option value="SCOTIABANK">SCOTIABANK</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Número de Cuenta / CCI</label> <b>*</b>
                                <input type="text" name="nro_cuenta" value="{{old('nro_cuenta')}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo de Cuenta</label> <b>*</b>
                                <select name="tipo_cuenta" class="form-control" required>
                                    <option value="AHORROS">AHORROS</option>
                                    <option value="CORRIENTE">CORRIENTE</option>
                                    <option value="CCI (INTERBANCARIA)">CCI (INTERBANCARIA)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contacto (Nombre)</label>
                                <input type="text" name="contacto_nombre" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Celular de Contacto</label>
                                <input type="text" name="celular" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <a href="{{ route('admin.proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Proveedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection