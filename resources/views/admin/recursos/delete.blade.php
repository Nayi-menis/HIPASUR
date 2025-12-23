@extends('layouts.admin')
@section('content')
  <div class="row">
    <h1>Eliminar Trabajador: {{$recurso->nombres}} {{$recurso->apellidos}}</h1>
  </div>

  <hr>

  <div class="row">
    <div class="col-md-12">
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h3 class="card-title">¿Estás seguro de eliminar este registro?</h3>
            </div>
          <div class="card-body">
            <form action="{{url('/admin/recursos', $recurso->id)}}" method="POST">
                @csrf
                @method('DELETE')
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Nombres</label>
                      <input type="text" value="{{$recurso->nombres}}" class="form-control" disabled>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Apellidos</label>
                      <input type="text" value="{{$recurso->apellidos}}" class="form-control" disabled>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Edad</label>
                      <input type="text" value="{{$recurso->edad}}" class="form-control" disabled>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">DNI</label>
                      <input type="text" value="{{$recurso->DNI}}" class="form-control" disabled>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Celular</label>
                      <input type="text" value="{{$recurso->celular}}" class="form-control" disabled>
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Fecha de nacimiento</label>
                      <input type="date" value="{{$recurso->fecha_nacimiento}}" class="form-control" disabled>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Número de cuenta ICC</label>
                      <input type="text" value="{{$recurso->cuenta}}" class="form-control" disabled>
                    </div>
                  </div>   
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Cuenta STC</label>
                      <input type="text" value="{{$recurso->stc}}" class="form-control" disabled>
                    </div>
                  </div>
                  <div class="col-md-4">
                   <div class="form-group">
                     <label for="">Email</label>
                     <input type="email" value="{{$recurso->email}}" class="form-control" disabled>
                   </div>
                  </div> 
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Departamento</label>
                      <input type="text" value="{{$recurso->departamento}}" class="form-control" disabled>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Provincia</label>
                      <input type="text" value="{{$recurso->provincia}}" class="form-control" disabled>
                    </div>
                  </div>
                </div>

                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <a href="{{url('admin/recursos')}}" class="btn btn-secondary">Cancelar</a>
                      <button type="submit" class="btn btn-danger">Eliminar Registro</button>
                    </div>
                  </div>
                </div>
              </form>  
            </div>
        </div>
    </div>
  </div>
@endsection