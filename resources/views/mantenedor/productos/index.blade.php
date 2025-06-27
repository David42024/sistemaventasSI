@extends('layout.plantilla')


@section('titulo', 'Listado de Productos')

@section('contenido')

    <!-- Default box -->
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Listado de Productos</h3>
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
            <a href="{{ route('productos.create') }}" class="btn btn-primary"><i class="fas faplus"></i> Nuevo Registro</a>
            <nav class="navbar navbar-light float-right">
                <form class="form-inline my-2 my-lg-0" method="GET">
                    <input name="buscarpor" class="form-control mr-sm2" type="search"
                        placeholder="Busqueda por descripcion" arialabel="Search" value="{{ $buscarpor }}">
                    <button class="btn btn-success my-2 my-sm0" type="submit">Buscar</button>
                </form>

            </nav>
           
                <div id="mensaje">
                    @if (session('datos'))
                        <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                            {{ session('datos') }}
                            <button type="button" class="close" data-dismiss="alert" arialabel="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Codigo</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Unidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($productos) <= 0)
                            <tr>
                                <td>No hay registros</td>
                            </tr>
                        @else
                            @foreach ($productos as $itemproducto)
                                <tr>
                                    <td>{{ $itemproducto->idproducto }}</td>
                                    <td>{{ $itemproducto->descripcion }}</td>
                                    <td>{{ $itemproducto->categoria->descripcion }}</td>
                                    <td>{{ $itemproducto->unidad->descripcion }}</td>
                                    <td>{{ $itemproducto->precio}}</td>
                                    <td>{{ $itemproducto->stock }}</td>
                                    <td><a href="{{route('productos.edit',$itemproducto->idproducto)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                                        <a href="{{route('productos.confirmar',$itemproducto->idproducto)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            Eliminar</a>
                                    </td>

                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
                {{ $productos->links() }}
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->


@endsection


@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                let mensaje = document.getElementById('mensaje');
                if (mensaje) mensaje.remove();
            }, 2000);
        });
    </script>
@endsection
