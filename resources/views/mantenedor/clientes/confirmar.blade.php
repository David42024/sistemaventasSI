@extends('layout.plantilla')
@section('contenido')
    <div class="container">
        <h1>Desea eliminar registro ? Codigo : {{ $cliente->idcliente }} - Apellidos y Nombres : {{ $cliente->apellidos . " ". $cliente->nombres }}
        </h1>
        <form method="POST" action="{{ route('clientes.destroy', $cliente->idcliente) }}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fas facheck-square"></i> SI</button>
            <a href="{{ route('clientes.cancelar') }}" class="btn btn-primary"><i class="fas fa-times-circle"></i>
                NO</button></a>
        </form>
    </div>
@endsection
