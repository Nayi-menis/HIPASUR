@extends('layouts.admin')
@section('content')
  <div class="row">
    <h1>Secretari@: {{$secretaria->nombres}} {{$secretaria->apellidos}}</h1>
  </div>

  <hr>

  <div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div><!-- /.card-header -->
          <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="from group">
                      <label for="">Nombres: </label>
                      <p>{{$secretaria->nombres}}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="from group">
                      <label for="">Apellidos: </label> 
                      <p>{{$secretaria->apellidos}}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="from group">
                      <label for="">DNI: </label>
                      <p>{{$secretaria->DNI}}</p>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <div class="from group">
                      <label for="">Celular: </label>
                      <p>{{$secretaria->celular}}</p>
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form group">
                      <label for="">Fecha de nacimiento: </label>
                      <p>{{$secretaria->fecha_nacimiento}}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="from group">
                      <label for="">Dirección: </label>
                      <p>{{$secretaria->direccion}}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="from group">
                      <label for="">Email: </label>
                      <p>{{$secretaria->user->email}}</p>
                    </div>
                  </div> 
                </div>
                <br>
                <div class="row">
                  <div class="col-md-8">
                    <div class="form group">
                      <a href="{{url('admin/secretarias')}}" class="btn btn-secondary">Cancelar</a>
                    </div>
                  </div>
                </div> 
             </div>
              <!-- /.card-body -->
        </div>
            <!-- /.card -->
    </div>
  </div>

@endsection