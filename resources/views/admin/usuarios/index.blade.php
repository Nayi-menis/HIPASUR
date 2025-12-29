@extends('layouts.admin')

@section('content')
  <div class="row">
    <h1>USUARIOS DE HIPASUR</h1>
  </div>
  <hr>

  <div class="row">
    <div class="col-md-12">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title">Usuarios Registrados</h3>
          <div class="card-tools">
            <a href="{{ url('admin/usuarios/create') }}" class="btn btn-primary">
              <i class="bi bi-person-plus"></i> Registrar Usuario
            </a>
          </div>
        </div>

        <div class="card-body">
          <table id="example1" class="table table-striped table-hover table-sm table-bordered">
            <thead class="thead-dark">
              <tr>
                <th style="text-align: center">Nro</th>
                <th style="text-align: center">Nombre</th>
                <th style="text-align: center">Email</th>
                <th style="text-align: center">Rol</th>
                <th style="text-align: center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @php $contador = 1; @endphp
             @foreach ($usuarios as $usuario)
              <tr>
                <td style="text-align: center">{{ $contador++ }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td style="text-align: center">
                  @php
                    $roleColors = [
                      'administrador' => 'background-color: #e9edfa; color: #3a4a8c;', // azul más suave
                      'secretaria'    => 'background-color: #e6f7ee; color: #218c5a;', // verde más suave
                      'encargado'     => 'background-color: #fff9ec; color: #b88c0b;', // amarillo más suave
                      'personal'      => 'background-color: #f4f4f4; color: #444;'      // gris más suave
                    ];
                    $colorStyle = $roleColors[$usuario->role] ?? 'background-color: #f4f4f4; color: #444;';
                  @endphp
                  <span style="
                    {{ $colorStyle }}
                    border-radius: 8px;
                    padding: 2px 10px;
                    font-size: 0.95em;
                    font-weight: 500;
                    border: 1px solid #e0e0e0;">
                    {{ ucfirst($usuario->role) }}
                  </span>
                </td>
                <td style="text-align: center">
                  <div class="btn-group" role="group">
                    <a href="{{ url('admin/usuarios/'.$usuario->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                    <a href="{{ url('admin/usuarios/'.$usuario->id.'/edit') }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                    <a href="{{ url('admin/usuarios/'.$usuario->id.'/confirm-delete') }}" class="btn btn-danger btn-sm"><i class="bi bi-trash2"></i></a>
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

  <script>
    $(function () {
      $("#example1").DataTable({
        "pageLength": 10,
        "language": {
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
          "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
          "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Usuarios",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscador:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
          }
        },
        "responsive": true, 
        "lengthChange": true, 
        "autoWidth": false,
        "buttons": [
          {
            extend: 'collection',
            text: 'Reportes',
            buttons: [
              { extend: 'copy', text: 'Copiar', title: 'HIPASUR - Reporte de Usuarios' },
              { extend: 'pdf', text: 'PDF', title: 'HIPASUR - Reporte de Usuarios', orientation: 'portrait', pageSize: 'A4' },
              { extend: 'csv', text: 'CSV', title: 'HIPASUR - Reporte de Usuarios' },
              { extend: 'excel', text: 'EXCEL', title: 'HIPASUR - Reporte de Usuarios' },
              { extend: 'print', text: 'Imprimir', title: 'HIPASUR - Reporte de Usuarios' }
            ]
          },
          { extend: 'colvis', text: 'Visor de columnas' }
        ]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection