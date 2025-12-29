@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar Reporte de Seguridad</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Modifique los datos necesarios</h3>
            </div>
            <form action="{{url('admin/seguridad', $seguridad->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" name="fecha" class="form-control" value="{{ $seguridad->fecha }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tipo_registro">Tipo de Registro</label>
                                <select name="tipo_registro" class="form-control" required>
                                    <option value="INCIDENTE" {{ $seguridad->tipo_registro == 'INCIDENTE' ? 'selected' : '' }}>INCIDENTE</option>
                                    <option value="INSPECCIÓN EPP" {{ $seguridad->tipo_registro == 'INSPECCIÓN EPP' ? 'selected' : '' }}>INSPECCIÓN EPP</option>
                                    <option value="CHARLA 5 MIN" {{ $seguridad->tipo_registro == 'CHARLA 5 MIN' ? 'selected' : '' }}>CHARLA 5 MIN</option>
                                    <option value="ACCIDENTE" {{ $seguridad->tipo_registro == 'ACCIDENTE' ? 'selected' : '' }}>ACCIDENTE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="area">Área</label>
                                <select name="area" class="form-control" required>
                                    <option value="MINA" {{ $seguridad->area == 'MINA' ? 'selected' : '' }}>MINA</option>
                                    <option value="TALLER" {{ $seguridad->area == 'TALLER' ? 'selected' : '' }}>TALLER</option>
                                    <option value="ALMACÉN" {{ $seguridad->area == 'ALMACÉN' ? 'selected' : '' }}>ALMACÉN</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nivel_riesgo">Nivel de Riesgo</label>
                                <select name="nivel_riesgo" class="form-control" required>
                                    <option value="BAJO" {{ $seguridad->nivel_riesgo == 'BAJO' ? 'selected' : '' }}>BAJO</option>
                                    <option value="MEDIO" {{ $seguridad->nivel_riesgo == 'MEDIO' ? 'selected' : '' }}>MEDIO</option>
                                    <option value="ALTO" {{ $seguridad->nivel_riesgo == 'ALTO' ? 'selected' : '' }}>ALTO</option>
                                    <option value="CRÍTICO" {{ $seguridad->nivel_riesgo == 'CRÍTICO' ? 'selected' : '' }}>CRÍTICO</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="responsable">Responsable</label>
                                <input type="text" name="responsable" class="form-control" value="{{ $seguridad->responsable }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" rows="4" class="form-control" required>{{ $seguridad->descripcion }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="accion_correctiva">Acción Correctiva</label>
                                <textarea name="accion_correctiva" rows="4" class="form-control">{{ $seguridad->accion_correctiva }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{url('admin/seguridad/') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-sync"></i> Actualizar Reporte
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection