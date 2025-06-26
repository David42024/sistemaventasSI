@extends('layout.plantilla')


@section('titulo', 'Listado de Clientes')

@section('contenido')


    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Crear Cliente</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>


        </div>
        <div class="card-body">
            <br>

                    <form method="POST" action="{{route('clientes.store')}}">
                        @csrf
                        <h4 class="form-title">Crear Cliente</h4>
                        <div class="form-group">
                            <label class="control-label">RUC o DNI:</label>
                            <div class="input-icon">
                                <input class="form-control @error('ruc_dni') is-invalid @enderror" type="text"
                                    placeholder="Ingrese ruc o dni" id="ruc_dni" name="ruc_dni"
                                    value="{{ old('ruc_dni') }}" />
                                @error('ruc_dni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Apellidos:</label>
                            <div class="input-icon">
                                <input class="form-control @error('apellidos') is-invalid @enderror" type="text"
                                    placeholder="Ingrese apellidos" id="apellidos" name="apellidos"
                                    value="{{ old('apellidos') }}" />
                                @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nombres:</label>
                            <div class="input-icon">
                                <input class="form-control @error('nombres') is-invalid @enderror" type="text"
                                    placeholder="Ingrese nombres" id="nombres" name="nombres"
                                    value="{{ old('nombres') }}" />
                                @error('nombres')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email:</label>
                            <div class="input-icon">
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                    placeholder="Ingrese email" id="email" name="email"
                                    value="{{ old('email') }}" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Direccion:</label>
                            <div class="input-icon">
                                <input class="form-control @error('direccion') is-invalid @enderror" type="text"
                                    placeholder="Ingrese direccion" id="direccion" name="direccion"
                                    value="{{ old('direccion') }}" />
                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    

                        <hr />
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success btn-block">
                                Guardar </button>
                              <a type="button" href="{{route('clientes.cancelar')}}" class="btn btn-danger btn-block">
                                Cancelar </a>
                                
                        </div>
                        <hr />
                    </form>
              
         
        </div>


        <!-- /.card-footer-->
    </div>

@endsection
