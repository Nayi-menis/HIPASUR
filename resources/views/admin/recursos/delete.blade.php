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
                <h3 class="card-title text-bold">¿Estás seguro de eliminar este registro?</h3>
            </div>
          <div class="card-body">
            <form action="{{url('/admin/recursos', $recurso->id)}}" method="POST">
                @csrf
                @method('DELETE')
                
                {{-- FILA 1: NOMBRES, APELLIDOS Y EDAD --}}
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Nombres</label>
                      <input type="text" value="{{$recurso->nombres}}" class="form-control" disabled>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Apellidos</label>
                      <input type="text" value="{{$recurso->apellidos}}" class="form-control" disabled>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Edad</label>
                      <input type="text" value="{{$recurso->edad}}" class="form-control" disabled>
                    </div>
                  </div>
                </div>

                {{-- FILA 2: DNI, CELULAR Y FECHA NACIMIENTO --}}
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>DNI</label>
                      <input type="text" value="{{$recurso->DNI}}" class="form-control" disabled>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Celular</label>
                      <input type="text" value="{{$recurso->celular}}" class="form-control" disabled>
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Fecha de nacimiento</label>
                      <input type="date" value="{{$recurso->fecha_nacimiento}}" class="form-control" disabled>
                    </div>
                  </div>
                </div>

                {{-- FILA 3: CARGO Y VEHÍCULO (DATOS CRÍTICOS) --}}
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Cargo</label>
                      {{-- Se usa el valor directamente del objeto recurso --}}
                      <input type="text" value="{{ $recurso->cargo }}" class="form-control" disabled style="background-color: #fdf2f2;">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Vehículo / Unidad Asignada</label>
                      <input type="text" value="{{ $recurso->vehiculo->codigo_interno ?? 'Sin unidad asignada' }}" class="form-control" disabled style="background-color: #fdf2f2;">
                    </div>
                  </div>
                </div>

                {{-- FILA 4: CUENTAS Y EMAIL --}}
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Número de cuenta ICC</label>
                      <input type="text" value="{{$recurso->cuenta}}" class="form-control" disabled>
                    </div>
                  </div>   
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Cuenta STC</label>
                      <input type="text" value="{{$recurso->stc}}" class="form-control" disabled>
                    </div>
                  </div>
                  <div class="col-md-4">
                   <div class="form-group">
                     <label>Email</label>
                     <input type="email" value="{{$recurso->user->email ?? $recurso->email}}" class="form-control" disabled>
                   </div>
                  </div> 
                </div>

                {{-- FILA 5: UBICACIÓN --}}
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Departamento</label>
                      <input type="text" value="{{$recurso->departamento}}" class="form-control" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Provincia</label>
                      <input type="text" value="{{$recurso->provincia}}" class="form-control" disabled>
                    </div>
                  </div>
                </div>

                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <a href="{{url('admin/recursos')}}" class="btn btn-secondary shadow-sm">Cancelar</a>
                      <button type="submit" class="btn btn-danger shadow-sm ml-2">
                          <i class="fas fa-trash"></i> Eliminar Registro Definitivamente
                      </button>
                    </div>
                  </div>
                </div>
              </form>  
            </div>
        </div>
    </div>
  </div>
@endsection