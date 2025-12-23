@extends('layouts.admin')
@section('content')
  <div class="row">
    <h1>Listado de Personal (Orden Base de Datos)</h1>
  </div>
  <hr>

  <div class="row">
    <div class="col-md-28">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Trabajadores Registrados - HIPASUR</h3>
            <div class="card-tools">
              <a href="{{url('admin/recursos/create')}}" class="btn btn-primary">
                <i class="bi bi-person-plus"></i> Registrar Trabajador
              </a>
            </div>
          </div>
          
          <div class="card-body">       
            <table id="example1" class="table table-striped table-hover table-sm table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th style="text-align: center">ID</th>
                    <th style="text-align: center">Nombres</th>
                    <th style="text-align: center">Apellidos</th>
                    <th style="text-align: center">Edad</th>
                    <th style="text-align: center">DNI</th>
                    <th style="text-align: center">Celular</th>
                    <th style="text-align: center">F.Nacimiento</th>
                    <th style="text-align: center">Cuenta ICC</th>
                    <th style="text-align: center">Cuenta STC</th>
                    <th style="text-align: center">Departamento</th>
                    <th style="text-align: center">Provincia</th>
                    <th style="text-align: center">Email</th>
                    <th style="text-align: center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($recursos as $recurso)
                      <tr>
                        <td style="text-align: center">{{ $recurso->id }}</td>
                        <td>{{ $recurso->nombres }}</td>
                        <td>{{ $recurso->apellidos }}</td>
                        <td style="text-align: center">{{ $recurso->edad }}</td>
                        <td>{{ $recurso->DNI }}</td>
                        <td>{{ $recurso->celular }}</td>
                        <td>{{ $recurso->fecha_nacimiento }}</td>
                        <td>{{ $recurso->cuenta }}</td>
                        <td>{{ $recurso->stc }}</td>
                        <td style="text-transform: uppercase;">{{ $recurso->departamento }}</td>
                        <td style="text-transform: uppercase;">{{ $recurso->provincia }}</td>
                        <td>{{ $recurso->user->email }}</td>
                        <td style="text-align: center">
                          <div class="btn-group" role="group">
                            <a href="{{url('admin/recursos/'.$recurso->id)}}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                            <a href="{{url('admin/recursos/'.$recurso->id.'/edit')}}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                            <a href="{{url('admin/recursos/'.$recurso->id.'/confirm-delete')}}" class="btn btn-danger btn-sm"><i class="bi bi-trash2"></i></a>
                          </div>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
            </table>

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
                                  { extend: 'pdf', title: 'REPORTE MAESTRO PERSONAL', orientation: 'landscape', pageSize: 'A4' },
                                  { extend: 'excel', title: 'PERSONAL_DB_EXPORT' },
                                  { extend: 'print', title: 'IMPRESIÓN GENERAL' }
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