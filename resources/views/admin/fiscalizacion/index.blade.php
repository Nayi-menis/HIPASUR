@extends('layouts.admin')

@section('content')
<div class="row pt-3">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title"><b>Historial de Fiscalizaciones</b></h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ url('admin/fiscalizacion/create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Nueva Fiscalización
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <table id="table_fiscalizacion" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th>Fecha</th>
                            <th>Entidad</th>
                            <th>Inspector</th>
                            <th>Motivo</th>
                            <th>Resultado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp
                        @foreach($fiscalizaciones as $fisc)
                        <tr>
                            <td>{{ $contador++ }}</td>
                            <td>{{ \Carbon\Carbon::parse($fisc->fecha)->format('d/m/Y') }}</td>
                            <td>{{ $fisc->entidad }}</td>
                            <td>{{ $fisc->inspector }}</td>
                            <td>{{ $fisc->motivo }}</td>
                            <td class="text-center">
                                @if($fisc->resultado == 'APROBADO')
                                    <span class="badge badge-success">APROBADO</span>
                                @elseif($fisc->resultado == 'CON OBSERVACIONES')
                                    <span class="badge badge-warning">CON OBSERVACIONES</span>
                                @else
                                    <span class="badge badge-danger">MULTA / SANCIÓN</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ url('admin/fiscalizacion/'. $fisc->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ url('admin/fiscalizacion/'. $fisc->id . '/edit') }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ url('admin/fiscalizacion/'. $fisc->id) }}" method="POST" onsubmit="return confirm('¿Eliminar registro?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection