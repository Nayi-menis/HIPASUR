@extends('layouts.admin')
@section('content')
  <div class="row">
    <h1>Editar Trabajador: {{$recurso->nombres}} {{$recurso->apellidos}}</h1>
  </div>

  <hr>

  <div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title text-bold">Modificar los datos necesarios</h3>
            </div>
          <div class="card-body">
            <form action="{{url('/admin/recursos', $recurso->id)}}" method="POST">
                @csrf
                @method('PUT')
                
                {{-- FILA 1: NOMBRES, APELLIDOS Y EDAD --}}
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Nombres</label> <b>*</b>
                      <input type="text" value="{{old('nombres', $recurso->nombres)}}" name="nombres" class="form-control" required>
                      @error('nombres')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Apellidos</label> <b>*</b>
                      <input type="text" value="{{old('apellidos', $recurso->apellidos)}}" name="apellidos" class="form-control" required>
                      @error('apellidos')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Edad</label> <b>*</b>
                      <input type="number" value="{{old('edad', $recurso->edad)}}" name="edad" class="form-control" required>
                      @error('edad')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                </div>

                {{-- FILA 2: DNI, CELULAR Y FECHA DE NACIMIENTO --}}
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">DNI</label> <b>*</b>
                      <input type="text" value="{{old('DNI', $recurso->DNI)}}" name="DNI" class="form-control" required>
                      @error('DNI')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Celular</label> <b>*</b>
                      <input type="text" value="{{old('celular', $recurso->celular)}}" name="celular" class="form-control" required>
                      @error('celular')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Fecha de nacimiento</label> <b>*</b>
                      <input type="date" value="{{old('fecha_nacimiento', $recurso->fecha_nacimiento)}}" name="fecha_nacimiento" class="form-control" required>
                      @error('fecha_nacimiento')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                </div>

                {{-- FILA 3: CARGO Y VEHÍCULO (NUEVOS CAMPOS) --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Cargo</label> <b>*</b>
                            <input type="text" value="{{old('cargo', $recurso->cargo)}}" name="cargo" class="form-control" required>
                            @error('cargo')
                            <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Vehículo / Unidad Asignada</label>
                            <select name="vehiculo_id" class="form-control">
                                <option value="">-- Seleccione una unidad --</option>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}" {{ (old('vehiculo_id', $recurso->vehiculo_id) == $vehiculo->id) ? 'selected' : '' }}>
                                        {{ $vehiculo->codigo_interno }} - {{ $vehiculo->tipo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vehiculo_id')
                            <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- FILA 4: CUENTAS Y EMAIL --}}
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Número de cuenta ICC</label> <b>*</b>
                      <input type="text" value="{{old('cuenta', $recurso->cuenta)}}" name="cuenta" class="form-control" required>
                      @error('cuenta')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>   
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Cuenta STC</label> <b>*</b>
                      <input type="text" value="{{old('stc', $recurso->stc)}}" name="stc" class="form-control" required>
                      @error('stc')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                   <div class="form-group">
                     <label for="">Email</label> <b>*</b>
                     @if(Auth::user()->role == 'administrador')
                       <input type="email" value="{{old('email', $recurso->user->email)}}" name="email" class="form-control" required>
                     @else
                       <input type="email" value="{{ $recurso->user->email }}" name="email" class="form-control" readonly style="background-color: #e9ecef;">
                     @endif
                     @error('email')
                     <small style="color: red">{{$message}}</small>
                     @enderror
                   </div>
                  </div> 
                </div>

                {{-- FILA 5: UBICACIÓN --}}
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Departamento</label> <b>*</b>
                      <input type="text" value="{{old('departamento', $recurso->departamento)}}" name="departamento" class="form-control" required>
                      @error('departamento')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Provincia</label> <b>*</b>
                      <input type="text" value="{{old('provincia', $recurso->provincia)}}" name="provincia" class="form-control" required>
                      @error('provincia')
                      <small style="color: red">{{$message}}</small>
                      @enderror
                    </div>
                  </div>
                </div>

                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <a href="{{url('admin/recursos')}}" class="btn btn-secondary shadow-sm">Cancelar</a>
                      <button type="submit" class="btn btn-success shadow-sm ml-2">
                          <i class="fas fa-save"></i> Actualizar Trabajador
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