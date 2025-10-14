@extends('layouts.admin')
@section('content')
  <div class="row">
    <h1>Eliminar secretari@: {{$secretaria->nombres}} {{$secretaria->apellidos}}</h1>
  </div>

  <hr>

  <div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">¿Estas seguro de eliminar este registro?</h3>
            </div><!-- /.card-header -->
          <div class="card-body">
            <form action="{{url('/admin/secretarias',$secretaria->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="row">
                  <div class="col-md-4">
                    <div class="from group">
                      <label for="">Nombres</label> 
                      <input type="text" value="{{$secretaria->nombres}}" name="nombres" class="form-control" disabled>
                      @error('nombres')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="from group">
                      <label for="">Apellidos</label>
                      <input type="text" value="{{$secretaria->apellidos}}" name="apellidos" class="form-control" disabled>
                      @error('apellidos')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="from group">
                      <label for="">DNI</label>
                      <input type="text" value="{{$secretaria->DNI}}" name="DNI" class="form-control" disabled>
                      @error('DNI')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <div class="from group">
                      <label for="">Celular</label>
                      <input type="text" value="{{$secretaria->celular}}" name="celular" class="form-control" disabled>
                      @error('celular')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>  
                  <div class="col-md-4">
                    <div class="form group">
                      <label for="">Fecha de nacimiento</label> 
                      <input type="date" value="{{$secretaria->fecha_nacimiento}}" name="fecha_nacimiento" class="form-control" disabled>
                      @error('fecha_nacimiento')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="from group">
                      <label for="">Dirección</label>
                      <input type="address" value="{{$secretaria->direccion}}" name="direccion" class="form-control" disabled>
                      @error('direccion')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-4">
                    <div class="from group">
                      <label for="">Email</label>
                      <input type="email" value="{{$secretaria->user->email}}" name="email" class="form-control" disabled>
                      @error('email')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div> 
                </div>
                <br>
                <div class="row">
                  <div class="col-md-8">
                    <div class="form group">
                      <a href="{{url('admin/secretarias')}}" class="btn btn-secondary">Cancelar</a>
                      <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                  </div>
                </div>
              </form>  
            </div>
              <!-- /.card-body -->
        </div>
            <!-- /.card -->
    </div>
  </div>

@endsection