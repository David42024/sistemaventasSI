@extends('layout.plantilla')


@section('titulo', 'Listado de Clientes')

@section('contenido')

    <!-- Default box -->
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Listado de Clientes</h3>
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
            <a href="{{ route('clientes.create') }}" class="btn btn-primary"><i class="fas faplus"></i> Nuevo Registro</a>
            <nav class="navbar navbar-light float-right">
                <form class="form-inline my-2 my-lg-0" method="GET">
                    <input name="buscarpor" class="form-control mr-sm2" type="search"
                        placeholder="Busqueda por ruc/dni" arialabel="Search" value="{{ $buscarpor }}">
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
                            <th scope="col">RUC/DNI</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Email</th>
                            <th scope="col">Direccion</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($clientes) <= 0)
                            <tr>
                                <td>No hay registros</td>
                            </tr>
                        @else
                            @foreach ($clientes as $itemcliente)
                                <tr>
                                    <td>{{ $itemcliente->idcliente }}</td>
                                    <td>{{ $itemcliente->ruc_dni }}</td>
                                    <td>{{ $itemcliente->apellidos }}</td>
                                    <td>{{ $itemcliente->nombres }}</td>
                                    <td>{{ $itemcliente->email }}</td>
                                    <td>{{ $itemcliente->direccion }}</td>
                                    <td><a href="{{route('clientes.edit',$itemcliente->idcliente)}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Editar</a>
                                        <a href="{{route('clientes.confirmar',$itemcliente->idcliente)}}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                            Eliminar</a>
                                    </td>

                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
                {{ $clientes->links() }}
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
