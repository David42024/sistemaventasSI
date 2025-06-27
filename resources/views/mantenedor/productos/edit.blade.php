@extends('layout.plantilla')


@section('titulo', 'Editar producto')

@section('contenido')


    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Editar Producto</h3>
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

                    <form method="POST" action="{{route('productos.update',$producto->idproducto)}}">
                        @csrf
                         @method('PUT')
                        <h4 class="form-title">Editar Producto {{$producto->idproducto}}</h4>
                        <div class="form-row">
                            <div class="form-group">
                            <label class="control-label">Id:</label>
                            <div class="input-icon">
                                <input class="form-control " type="text"
                                    id="id" name="idproducto" value="{{$producto->idproducto}}"
                                    value="{{ old('id') }}" disabled />
                            </div>
                        </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="control-label" for="descripcion">Descripción:</label>
                                <div class="input-icon">
                    
                                    <input class="form-control @error('descripcion') is-invalid @enderror" type="text"
                                        placeholder="Ingrese descripcion" id="descripcion" name="descripcion" value="{{$producto->descripcion}}"
                                        value="{{ old('descripcion') }}" />
                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="control-label">Categoria</label>
                                <select class="form-control" name="idcategoria" id="idcategoria">
                                    @foreach ($categorias as $itemcategoria)
                                        <option value="{{ $itemcategoria->idcategoria }}" {{$itemcategoria->idcategoria == $producto->idcategoria ? 'selected' : ''}}>
                                        {{ $itemcategoria->descripcion }}
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="control-label">Unidad</label>
                                <select class="form-control" name="idunidad" id="idunidad">
                                    @foreach ($unidades as $itemunidad)
                                        <option value="{{ $itemunidad->idunidad }}">{{ $itemunidad->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="control-label" for="precio">Precio:</label>
                                <div class="input-icon">
                                    <input class="form-control @error('precio') is-invalid @enderror" type="text"
                                        placeholder="Ingrese precio" id="precio" name="precio" value="{{$producto->precio}}"
                                        value="{{ old('precio') }}" />
                                    @error('precio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-row">
                            <div class="form-group">
                                <label class="control-label" for="stock">Stock:</label>
                                <div class="input-icon">
                                    <input class="form-control @error('stock') is-invalid @enderror" type="text"
                                        placeholder="Ingrese stock" id="stock" name="stock" value="{{$producto->stock}}"
                                        value="{{ old('stock') }}" />
                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr />
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success btn-block">
                                Guardar </button>
                              <a type="button" href="{{route('productos.cancelar')}}" class="btn btn-danger btn-block">
                                Cancelar </a>
                        </div>
                        <hr />
                    </form>
              
         
        </div>


        <!-- /.card-footer-->
    </div>

@endsection
