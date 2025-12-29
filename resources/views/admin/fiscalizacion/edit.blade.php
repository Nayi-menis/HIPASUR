@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar Registro de Fiscalización</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Modificar datos de la Inspección</h3>
            </div>
            <form action="{{url('admin/fiscalizacion', $fiscalizacion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha">Fecha de Visita</label>
                                <input type="date" name="fecha" class="form-control" value="{{ $fiscalizacion->fecha }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="entidad">Entidad Fiscalizadora</label>
                                <input type="text" name="entidad" class="form-control" value="{{ $fiscalizacion->entidad }}" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inspector">Nombre del Inspector</label>
                                <input type="text" name="inspector" class="form-control" value="{{ $fiscalizacion->inspector }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="motivo">Motivo de la Fiscalización</label>
                                <input type="text" name="motivo" class="form-control" value="{{ $fiscalizacion->motivo }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resultado">Resultado Final</label>
                                <select name="resultado" class="form-control" required>
                                    <option value="APROBADO" {{ $fiscalizacion->resultado == 'APROBADO' ? 'selected' : '' }}>APROBADO</option>
                                    <option value="CON OBSERVACIONES" {{ $fiscalizacion->resultado == 'CON OBSERVACIONES' ? 'selected' : '' }}>CON OBSERVACIONES</option>
                                    <option value="MULTA/SANCIÓN" {{ $fiscalizacion->resultado == 'MULTA/SANCIÓN' ? 'selected' : '' }}>MULTA / SANCIÓN</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="observaciones">Observaciones Detalladas</label>
                                <textarea name="observaciones" rows="4" class="form-control">{{ $fiscalizacion->observaciones }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="medidas_adoptadas">Medidas Adoptadas / Plan de Acción</label>
                                <textarea name="medidas_adoptadas" rows="4" class="form-control">{{ $fiscalizacion->medidas_adoptadas }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{url('admin/fiscalizacion') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-sync"></i> Actualizar Fiscalización
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection