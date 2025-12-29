<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HIPASUR.SAC | Panel de Control</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{url('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  
  <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{URL('/admin')}}" class="nav-link">Sistema de Gestión HIPASUR</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            @if(isset($totalNotificaciones) && $totalNotificaciones > 0)
                <span class="badge badge-danger navbar-badge">{{ $totalNotificaciones }}</span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">{{ $totalNotificaciones ?? 0 }} Alertas de Almacén</span>
            <div class="dropdown-divider"></div>
            
            @if(isset($productosBajoStock) && $productosBajoStock->count() > 0)
                @foreach($productosBajoStock as $item)
                    <a href="{{ url('admin/almacen') }}" class="dropdown-item">
                        <i class="fas fa-exclamation-triangle mr-2 text-danger"></i> 
                        {{ $item->nombre }} (Quedan: {{ $item->stock }})
                    </a>
                @endforeach
            @else
                <a href="#" class="dropdown-item text-center">Todo el stock está conforme</a>
            @endif
            
            <div class="dropdown-divider"></div>
            <a href="{{ url('admin/almacen') }}" class="dropdown-item dropdown-footer">Ver Almacén Completo</a>
        </div>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{url('/admin')}}" class="brand-link">
      <img src="{{url('dist/img/AdminLTELogo.png')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">HIPASUR.SAC</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><i class="bi bi-person-check-fill mr-2"></i> {{Auth::user()->name}}</a>
          <small class="text-warning">Rol: {{ strtoupper(Auth::user()->role) }}</small>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          {{-- NIVEL 1: SOLO ADMINISTRADOR --}}
          @if(Auth::user()->role == 'administrador')
          <li class="nav-header">ADMINISTRACIÓN CENTRAL</li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-person-circle"></i>
              <p>Usuarios<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{url('admin/usuarios/create')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Nuevo Usuario</p></a></li>
              <li class="nav-item"><a href="{{url('admin/usuarios')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Lista de Usuarios</p></a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link active" style="background-color: #28a745">
              <i class="nav-icon fas bi bi-cash"></i>
              <p>Control de Finanzas<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{url('admin/pagos/create')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Registrar Pago</p></a></li>
              <li class="nav-item"><a href="{{url('admin/pagos')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Historial Financiero</p></a></li>
            </ul>
          </li>
          @endif

          {{-- NIVEL 2: ADMINISTRADOR, SECRETARIA Y ENCARGADO --}}
          @if(in_array(Auth::user()->role, ['administrador', 'secretaria', 'encargado']))
          <li class="nav-header">GESTIÓN OPERATIVA</li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-person-bounding-box"></i>
              <p>Secretarias<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{url('admin/secretarias/create')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Registrar</p></a></li>
              <li class="nav-item"><a href="{{url('admin/secretarias')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Listado</p></a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-people-fill"></i>
              <p>Recursos Humanos<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{url('admin/recursos/create')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Nuevo Trabajador</p></a></li>
              <li class="nav-item"><a href="{{url('admin/recursos')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Lista Personal</p></a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-calendar4-week"></i>
              <p>Horarios y Turnos<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{url('admin/horarios/control')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Control Asistencia</p></a></li>
              <li class="nav-item"><a href="{{url('admin/horarios')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Listado Turnos</p></a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-clipboard2-fill"></i>
              <p>Fiscalización<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{url('admin/fiscalizacion/create')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Nuevo Registro</p></a></li>
              <li class="nav-item"><a href="{{url('admin/fiscalizacion')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Ver Auditorías</p></a></li>
            </ul>
          </li>
          @endif

          {{-- NIVEL 3: MODULOS OPERATIVOS (TODOS + ENCARGADO) --}}
          @if(in_array(Auth::user()->role, ['administrador', 'secretaria', 'personal', 'encargado']))
          <li class="nav-header">MÓDULOS DE CAMPO</li>
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-circle-fill"></i>
              <p>Producción Minera<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{url('admin/produccion/create')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Reportar Producción</p></a></li>
              <li class="nav-item"><a href="{{url('admin/produccion')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Listado</p></a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-box-seam-fill"></i>
              <p>Almacén e Inventario<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{url('admin/almacen/create')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Nuevo Producto</p></a></li>
              <li class="nav-item"><a href="{{url('admin/almacen')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Inventario</p></a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-car-front-fill"></i>
              <p>Vehículos/Maquinaria<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{url('admin/vehiculos/create')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Registrar Unidad</p></a></li>
              <li class="nav-item"><a href="{{url('admin/vehiculos')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Listado Maquinaria</p></a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-bandaid-fill"></i>
              <p>Seguridad y Salud<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="{{url('admin/seguridad/create')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Registrar Incidente</p></a></li>
              <li class="nav-item"><a href="{{url('admin/seguridad')}}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Manuales y Listado</p></a></li>
            </ul>
          </li>
          @endif

          <li class="nav-item mt-4">
            <a href="{{ route('logout') }}" class="nav-link" style="background-color: #dc3545; color: white"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon fas bi bi-door-closed-fill"></i>
              <p>CERRAR SESIÓN</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    <div class="content pt-3">
      <div class="container-fluid">
        @if( (($message=Session::get('mensaje')) && ($icono=Session::get('icono')) ))
          <script>
            Swal.fire({
              position: "top-end",
              icon: "{{$icono}}",
              title:"{{$message}}",
              showConfirmButton: false,
              timer: 3500
            });
          </script>
        @endif

        @yield('content')
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      <b>Versión</b> 2.0 | PRESENTADO POR: NAYELI LIZBETH MENA CCORI
    </div>
    <strong>Puno &copy; 2025 <a href="#">HIPASUR.SAC</a>.</strong> Todos los derechos reservados.
  </footer>
</div>


<script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>

<script src="{{url('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="{{url('dist/js/adminlte.min.js')}}"></script>

@yield('scripts')
</body>
</html>
