@extends('layouts.admin')
@section('content')
  <div class="row">
    <h1> Listado de Trabajadores</h1>
  </div>
  <hr>

  <div class="row">
    <div class="col-md-13">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Trabajadores Registrados</h3>

                <div class="card-tools">
                  <a href="{{url('admin/recursos/create')}}" class="btn btn-primary">
                    Regirtar Trabajador
                  </a>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">       
                <table id="example1" class="table table-triped table-hover table-sm table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th style="text-align: center"><b>Nro</b></th>
                    <th style="text-align: center"><b>Nombres</b></th>
                    <th style="text-align: center"><b>Apellidos</b></th>
                    <th style="text-align: center"><b>Edad</b></th>
                    <th style="text-align: center"><b>DNI</b></th>
                    <th style="text-align: center"><b>Celular</b></th>
                    <th style="text-align: center"><b>Fecha de nacimiento</b></th>
                    <th style="text-align: center"><b>Departamento</b></th>
                    <th style="text-align: center"><b>Provincia</b></th>
                    <th style="text-align: center"><b>Email</b></th>
                    <th style="text-align: center"><b>Acciones</b></th>
                  </tr>
                </thead>
                <tbody>
                  <?php $contador = 1; ?>
                  @foreach ($recursos as $recurso)
                      <tr>
                        <td style="text-align: center">{{ $contador++}}</td>
                        <td>{{ $recurso->nombres}}</td>
                        <td>{{ $recurso->apellidos}}</td>
                        <td>{{ $recurso->edad}}</td>
                        <td>{{ $recurso->DNI}}</td>
                        <td>{{ $recurso->celular}}</td>
                        <td>{{ $recurso->fecha_nacimiento}}</td>
                        <td>{{ $recurso->departamento}}</td>
                        <td>{{ $recurso->provincia}}</td>
                        <td>{{ $recurso->user->email}}</td>
                        <td style="text-align: center">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{url('admin/recursos/'.$recurso->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                            <a href="{{url('admin/recursos/'.$recurso->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                            <a href="{{url('admin/recursos/'.$recurso->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash2"></i></a>
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
                                  "info": "Mostrando _START_ a _END_ de _TOTAL_ Trabajadores",
                                  "infoEmpty": "Mostrando 0 a 0 de 0 Trabajadores",
                                  "infoFiltered": "(Filtrado de _MAX_ Total Trabajadores)",
                                  "infoPostFix": "",
                                  "thousands": ",",
                                  "lengthMenu": "Mostrar _MENU_ Trabajadores",
                                  "loadingRecords": "Cargando...",
                                  "processing": "Procesando...",
                                  "search": "Buscador:",
                                  "zeroRecords": "Sin resultados encontrados",
                                  "paginate": {
                                      "first": "Primero",
                                      "last": "Ultimo",
                                      "next": "Siguiente",
                                      "previous": "Anterior"
                                  }
                              },
                              "responsive": true, "lengthChange": true, "autoWidth": false,
                              buttons: [
                                  {
                                      extend: 'collection',
                                      text: 'Reportes',
                                      orientation: 'landscape',
                                      buttons: [
                                          {
                                              text: 'Copiar',
                                              extend: 'copy',
                                              title: 'HIPASUR'
                                          },
                                          {
                                              extend: 'pdf',
                                              text: 'PDF',
                                              title: 'HIPASUR', // Título del PDF
                                              orientation: 'portrait',
                                              pageSize: 'A4',
                                              exportOptions: {
                                                  columns: ':visible'
                                              }
                                          },
                                          {
                                              extend: 'csv',
                                              text: 'CSV',
                                              title: 'HIPASUR', // Título del CSV
                                          },
                                          {
                                              extend: 'excel',
                                              text: 'EXCEL',
                                              title: 'HIPASUR', // Título del Excel
                                          },
                                          {
                                              text: 'Imprimir',
                                              extend: 'print',
                                              title: 'HIPASUR', // Título de la impresión
                                          }
                                      ]
                                  },
                                  {
                                      extend: 'colvis',
                                      text: 'Visor de columnas',
                                      collectionLayout: 'fixed three-column'
                                  }
                              ],
                          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                      });
                    </script>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
  
  </div>

@endsection

