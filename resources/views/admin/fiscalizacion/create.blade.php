@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Registrar Nueva Fiscalización</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Datos de la Inspección / Auditoría</h3>
                    </div>
                    <form action="{{url('admin/fiscalizacion/create') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha">Fecha de Visita</label>
                                        <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}" required>
                                        @error('fecha') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="entidad">Entidad Fiscalizadora</label>
                                        <input type="text" name="entidad" class="form-control" placeholder="Ej: SUNAFIL, SUNAT, OEFA" value="{{ old('entidad') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inspector">Nombre del Inspector</label>
                                        <input type="text" name="inspector" class="form-control" placeholder="Nombre completo" value="{{ old('inspector') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="motivo">Motivo de la Fiscalización</label>
                                        <input type="text" name="motivo" class="form-control" placeholder="Ej: Inspección rutinaria, Denuncia, Auditoría anual" value="{{ old('motivo') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="resultado">Resultado Final</label>
                                        <select name="resultado" class="form-control" required>
                                            <option value="APROBADO">APROBADO (Sin observaciones)</option>
                                            <option value="CON OBSERVACIONES">CON OBSERVACIONES</option>
                                            <option value="MULTA/SANCIÓN">MULTA / SANCIÓN</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="observaciones">Observaciones Detalladas</label>
                                        <textarea name="observaciones" rows="4" class="form-control" placeholder="Escriba aquí los hallazgos del inspector...">{{ old('observaciones') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="medidas_adoptadas">Medidas Adoptadas / Plan de Acción</label>
                                        <textarea name="medidas_adoptadas" rows="4" class="form-control" placeholder="¿Qué se hizo para levantar las observaciones?">{{ old('medidas_adoptadas') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <a href="{{url('admin/fiscalizacion')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Fiscalización
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection