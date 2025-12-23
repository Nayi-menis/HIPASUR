@extends('layouts.admin')
@section('content')
  <div class="row">
    <h1>Información del Trabajador: {{$recurso->nombres}} {{$recurso->apellidos}}</h1>
  </div>

  <hr>

  <div class="row">
    <div class="col-md-14">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>
          <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Nombres</label>
                      <p class="form-control bg-light">{{$recurso->nombres}}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Apellidos</label>
                      <p class="form-control bg-light">{{$recurso->apellidos}}</p>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="">Edad</label>
                      <p class="form-control bg-light">{{$recurso->edad}} años</p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">DNI</label>
                      <p class="form-control bg-light">{{$recurso->DNI}}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Celular</label>
                      <p class="form-control bg-light">{{$recurso->celular}}</p>
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Fecha de nacimiento</label>
                      <p class="form-control bg-light">{{$recurso->fecha_nacimiento}}</p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Número de cuenta ICC</label>
                      <p class="form-control bg-light">{{$recurso->cuenta}}</p>
                    </div>
                  </div>   
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Cuenta STC</label>
                      <p class="form-control bg-light">{{$recurso->stc}}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                   <div class="form-group">
                     <label for="">Email</label>
                     <input type="email" value="{{ $recurso->user->email }}" class="form-control" disabled>
                   </div>
                  </div> 

                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Departamento</label>
                      <p class="form-control bg-light">{{$recurso->departamento}}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Provincia</label>
                      <p class="form-control bg-light">{{$recurso->provincia}}</p>
                    </div>
                  </div>
                </div>

                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <a href="{{url('admin/recursos')}}" class="btn btn-secondary">Volver al listado</a>
                      <a href="{{url('admin/recursos/'.$recurso->id.'/edit')}}" class="btn btn-success">Editar Datos</a>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection