@extends('layouts.admin')
@section('content')
  <div class="row">
    <h1> Panel Principal</h1>
  </div>

  <div class="row">
    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$total_usuarios}}</h3>
                <p>Usuarios</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"><i class="fast bi bi-person-circle"></i></i>
              </div>
              <a href="{{url('admin/usuarios')}}" class="small-box-footer">Mas información <i class="fast bi bi-person-circle"></i></a>
            </div>
          </div>

    <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$total_secretarias}}</h3>
                <p>Secretari@s</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"><i class="fast bi bi-file-person"></i></i>
              </div>
              <a href="{{url('admin/secretarias')}}" class="small-box-footer">Mas información <i class="fast bi bi-file-person"></i></a>
            </div>
      </div>

      <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$total_pacientes}}</h3>
                <p>Trabajadores</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"><i class="fast bi bi-gitlab"></i></i>
              </div>
              <a href="{{url('admin/pacientes')}}" class="small-box-footer">Mas información <i class="fast bi bi-gitlab"></i></a>
            </div>
      </div>

       <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{$total_consultorios}}</h3>
                <p>Consultorios</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"><i class="fast bi bi-building-add"></i></i>
              </div>
              <a href="{{url('admin/consultorios')}}" class="small-box-footer">Mas información <i class="fast bi bi-building-add"></i></a>
            </div>
       </div>

       <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$total_doctores}}</h3>
                <p>Doctores</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"><i class="fast bi bi-person-heart"></i></i>
              </div>
              <a href="{{url('admin/doctores')}}" class="small-box-footer">Mas información <i class="fast bi bi-person-heart"></i></a>
            </div>
       </div>

       <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$total_horarios}}</h3>
                <p>Horarios</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"><i class="fast bi bi-calendar2-week"></i></i>
              </div>
              <a href="{{url('admin/horarios')}}" class="small-box-footer">Mas información <i class="fast bi bi-calendar2-week"></i></a>
            </div>
       </div>
      
  </div>
@endsection