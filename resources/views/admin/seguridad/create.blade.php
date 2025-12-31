@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Registrar Reporte de Seguridad y Salud</h1>
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
                        <h3 class="card-title">Datos del Registro</h3>
                    </div>
                    <form action="{{url('admin/seguridad/create') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}" required>
                                        @error('fecha') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipo_registro">Tipo de Registro</label>
                                        <select name="tipo_registro" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            <option value="INCIDENTE">INCIDENTE</option>
                                            <option value="INSPECCIÓN EPP">INSPECCIÓN EPP</option>
                                            <option value="CHARLA 5 MIN">CHARLA 5 MIN</option>
                                            <option value="ACCIDENTE">ACCIDENTE</option>
                                            <option value="OBSERVACIÓN">OBSERVACIÓN</option>
                                            <option value="OTRO">OTRO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="area">Área</label>
                                        <select name="area" class="form-control" required>
                                            <option value="">-- Seleccione --</option>
                                            <option value="MINA">MINA</option>
                                            <option value="TALLER">TALLER</option>
                                            <option value="ALMACÉN">ALMACÉN</option>
                                            <option value="PLANTA">PLANTA</option>
                                            <option value="OFICINAS">OFICINAS</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nivel_riesgo">Nivel de Riesgo</label>
                                        <select name="nivel_riesgo" class="form-control" required>
                                            <option value="BAJO">BAJO (Verde)</option>
                                            <option value="MEDIO">MEDIO (Amarillo)</option>
                                            <option value="ALTO">ALTO (Naranja)</option>
                                            <option value="CRÍTICO">CRÍTICO (Rojo)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="responsable">Responsable / Reportado por:</label>
                                        <input type="text" name="responsable" class="form-control" placeholder="Nombre completo de la persona" value="{{ old('responsable') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción del Hallazgo / Incidente</label>
                                        <textarea name="descripcion" rows="4" class="form-control" placeholder="Describa detalladamente lo ocurrido o inspeccionado..." required>{{ old('descripcion') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="accion_correctiva">Acción Correctiva (Opcional)</label>
                                        <textarea name="accion_correctiva" rows="4" class="form-control" placeholder="¿Qué medidas se tomaron de inmediato?">{{ old('accion_correctiva') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <a href="{{url('admin/seguridad') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Reporte
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection