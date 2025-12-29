@extends('layouts.admin')
@section('content')
  <div class="row">
    <h1>GESTIÓN DE RECURSOS HUMANOS</h1>
  </div>
  <hr>

  <div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Trabajadores Registrados - HIPASUR</h3>
            <div class="card-tools">
              <a href="{{url('admin/recursos/create')}}" class="btn btn-primary">
                <i class="bi bi-person-plus"></i> Registrar Trabajador
              </a>
            </div>
          </div>
          
          <div class="card-body p-1"> 
    <div class="table-responsive"> 
        <table id="example1" class="table table-striped table-hover table-sm table-bordered" style="font-size: 0.85rem;">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center align-middle" style="width: 20px">ID</th>
                    <th class="text-center align-middle">Nombre Completo</th>
                    <th class="text-center align-middle">Cargo</th>
                    <th class="text-center align-middle">Unidad</th>
                    <th class="text-center align-middle">DNI</th>
                    <th class="text-center align-middle">Celular</th>
                    <th class="text-center align-middle">Cta. ICC</th> {{-- Nombre abreviado --}}
                    <th class="text-center align-middle">Cta. STC</th> {{-- Nombre abreviado --}}
                    <th class="text-center align-middle">Ubicación</th> {{-- Nombre abreviado --}}
                    <th class="text-center align-middle">Email</th>
                    <th class="text-center align-middle" style="width: 100px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recursos as $recurso)
                    <tr>
                        <td class="text-center align-middle">{{ $recurso->id }}</td>
                        <td class="align-middle" style="white-space: nowrap;">{{ $recurso->nombres }} {{ $recurso->apellidos }}</td>
                        
                        <td class="text-center align-middle">
                            <span class="badge badge-info" style="font-size: 0.7rem;">{{ strtoupper($recurso->cargo ?? 'N/A') }}</span>
                        </td>
                        
                        <td class="text-center align-middle" style="line-height: 1;">
                            @if($recurso->vehiculo)
                                <b style="font-size: 0.75rem;">{{ $recurso->vehiculo->codigo_interno }}</b>
                            @else
                                <span class="text-muted small">Sin asignar</span>
                            @endif
                        </td>

                        <td class="align-middle">{{ $recurso->DNI }}</td>
                        <td class="align-middle">{{ $recurso->celular }}</td>
                        <td class="align-middle small">{{ $recurso->cuenta }}</td>
                        <td class="align-middle small">{{ $recurso->stc }}</td>
                        <td class="align-middle small" style="text-transform: uppercase;">{{ $recurso->departamento }}</td>
                        <td class="align-middle small">{{ $recurso->user->email }}</td>
                        
                        <td class="text-center align-middle">
                            <div class="btn-group">
                                <a href="{{url('admin/recursos/'.$recurso->id)}}" class="btn btn-info btn-xs"><i class="bi bi-eye"></i></a>
                                <a href="{{url('admin/recursos/'.$recurso->id.'/edit')}}" class="btn btn-success btn-xs"><i class="bi bi-pencil-square"></i></a>
                                <a href="{{url('admin/recursos/'.$recurso->id.'/confirm-delete')}}" class="btn btn-danger btn-xs"><i class="bi bi-trash2"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

            <script>
                $(function () {
                  $("#example1").DataTable({
                      "pageLength": 10,
                      "language": {
                          "emptyTable": "No hay información",
                          "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                          "search": "Buscador:",
                          "paginate": { "first": "Primero", "last": "Ultimo", "next": "Siguiente", "previous": "Anterior" }
                      },
                      "responsive": true, "lengthChange": true, "autoWidth": false,
                      buttons: [
                          {
                              extend: 'collection',
                              text: 'Reportes',
                              buttons: [
                                  { 
                                    extend: 'pdf', 
                                    title: 'REPORTE MAESTRO PERSONAL', 
                                    orientation: 'landscape', 
                                    pageSize: 'A4',
                                    exportOptions: { columns: ':visible' } // Exporta solo columnas visibles
                                  },
                                  { 
                                    extend: 'excel', 
                                    title: 'PERSONAL_DB_EXPORT',
                                    exportOptions: { columns: ':visible' }
                                  },
                                  { 
                                    extend: 'print', 
                                    title: 'IMPRESIÓN GENERAL',
                                    exportOptions: { columns: ':visible' }
                                  }
                              ]
                          },
                          { extend: 'colvis', text: 'Columnas' }
                      ],
                  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                });
            </script>
          </div>
        </div>
    </div>
  </div>
@endsection