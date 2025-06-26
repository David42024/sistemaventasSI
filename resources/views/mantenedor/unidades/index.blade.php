@extends('layout.plantilla')


@section('titulo', 'Listado de Unidades')

@section('contenido')

    <!-- Default box -->
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Listado de Unidades</h3>
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
            <a href="{{ route('unidades.create') }}" class="btn btn-primary"><i class="fas faplus"></i> Nuevo Registro</a>
            <nav class="navbar navbar-light float-right">
                <form class="form-inline my-2 my-lg-0" method="GET">
                    <input name="buscarpor" class="form-control mr-sm2" type="search"
                        placeholder="Busqueda por descripcion" arialabel="Search" value="{{ $buscarpor }}">
                    <button class="btn btn-success my-2 my-sm0" type="submit">Buscar</button>
                </form>

            </nav>
           
                <div id="mensaje">
                    @if (session('datos'))
                        <div class="alert alert-warning alert-dismissible fade show mt3" role="alert">
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
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($unidades) <= 0)
                            <tr>
                                <td>No hay registros</td>
                            </tr>
                        @else
                            @foreach ($unidades as $itemunidad)
                                <tr>
                                    <td>{{ $itemunidad->idunidad }}</td>
                                    <td>{{ $itemunidad->descripcion }}</td>
                                    <td><a href="{{route('unidades.edit',$itemunidad->idunidad)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                                        <a href="{{route('unidades.confirmar',$itemunidad->idunidad)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            Eliminar</a>
                                    </td>

                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
                {{ $unidades->links() }}
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
