@extends('layout.plantilla')


@section('titulo', 'Editar categoria')

@section('contenido')


    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Editar Categoria</h3>
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

                    <form method="POST" action="{{route('categorias.update',$categoria->idcategoria)}}">
                        @csrf
                         @method('PUT')
                        <h4 class="form-title">Editar Categoria {{$categoria->idcategoria}}</h4>
                                  <div class="form-group">
                            <label class="control-label">Id:</label>
                            <div class="input-icon">
                
                                <input class="form-control " type="text"
                                    id="id" name="idcategoria" value="{{$categoria->idcategoria}}"
                                    value="{{ old('id') }}" disabled />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Descripción:</label>
                            <div class="input-icon">
                
                                <input class="form-control @error('descripcion') is-invalid @enderror" type="text"
                                    placeholder="Ingrese usuario" id="descripcion" name="descripcion" value="{{$categoria->descripcion}}"
                                    value="{{ old('descripcion') }}" />
                                @error('descripcion')
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
                              <a type="button" href="{{route('categorias.cancelar')}}" class="btn btn-danger btn-block">
                                Cancelar </a>
                                
                        </div>
                        <hr />
                    </form>
              
         
        </div>


        <!-- /.card-footer-->
    </div>

@endsection
