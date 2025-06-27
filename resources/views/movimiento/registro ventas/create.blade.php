@extends('layout.plantilla') 
 
@section('estilos') 
<link rel="stylesheet" href="/assets/calendario/css/bootstrap-datepicker.standalone.css"> 
<link rel="stylesheet" href="/assets/select2/bootstrap-select.min.css"> 
@endsection 


@section('contenido') 
<div class="container"> 
    <h1 class="mb-4">Registrar Venta</h1>
    <div class="alert hidden" role="alert"></div>

    <form method="POST" action="{{ route('ventas.store') }}">
        @csrf

        {{-- Fecha y Tipo --}}
        <div class="form-row align-items-end">
            <div class="form-group col-md-3">
                <label for="fecha">Fecha</label>
                <div class="input-group date form_date" data-date-format="dd/mm/yyyy" data-provide="datepicker">
                    <input type="text" class="form-control text-center" name="fecha" id="fecha"
                           value="{{ Carbon\Carbon::now()->format('d/m/Y') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary date-set" type="button">
                            <i class="fa fa-calendar"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-3">
                <label for="seltipo">Tipo</label>
                <select class="form-control selectpicker" id="seltipo" name="seltipo" onchange="mostrarTipo()">
                    <option value="0">- Seleccione Tipo -</option>
                    @foreach($tipo as $itemtipo)
                        <option value="{{$itemtipo['idtipo']}}" >{{$itemtipo['descripcion']}}</option> 
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="nrodoc">Nro. Documento</label>
                <input type="text" class="form-control" name="nrodoc" id="nrodoc" readonly> 
            </div>
        </div>

        {{-- Cliente --}}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="idcliente">Cliente</label>
                <select class="form-control selectpicker" data-live-search="true" id="idcliente" name="idcliente">
                    <option value="0">- Seleccione Cliente -</option>
                    @foreach($cliente as $itemcliente)
                        <option value="{{ $itemcliente->idcliente }}_{{ $itemcliente->ruc_dni }}_{{ $itemcliente->direccion }}">
                            {{ $itemcliente->apellidos . " " . $itemcliente->nombres }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="ruc">RUC/DNI</label>
                <input type="text" class="form-control" name="ruc" id="ruc" readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" name="direccion" id="direccion" readonly>
            </div>
        </div>

        {{-- Producto --}}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="idproducto">Producto</label>
                <select class="form-control selectpicker" data-live-search="true" id="idproducto" name="idproducto">
                    <option value="0">- Seleccione Producto -</option>
                    @foreach($producto as $itemproducto)
                        <option value="{{ $itemproducto->idproducto }}">{{ $itemproducto->descripcion }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="unidad">Unidad</label>
                <input type="text" class="form-control" name="unidad" id="unidad" readonly>
            </div>

            <div class="form-group col-md-2">
                <label for="precio">Precio</label>
                <input type="text" class="form-control" name="precio" id="precio" readonly>
            </div>

            <div class="form-group col-md-2">
                <label for="cantidad">Cantidad</label>
                <input type="text" class="form-control" name="cantidad" id="cantidad">
            </div>
        </div>

        {{-- Botón agregar --}}
        <div class="form-row">
            <div class="col-md-12 text-right mb-3">
                <button type="button" id="btnadddet" class="btn btn-success btn-block">
                    <i class="fas fa-shopping-cart"></i> Agregar al carrito
                </button>
            </div>
        </div>

        <div class="col-md-2"> 
            <input type="text" class="form-control" name="stock" id="stock" hidden>                               
        </div> 

        {{-- Tabla --}}
        <div class="table-responsive mb-3">
            <table id="detalles" class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">Opciones</th>
                        <th class="text-center">Código</th>
                        <th>Descripción</th>
                        <th>Unidad</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">P. Venta</th>
                        <th class="text-center">Importe</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        {{-- Total --}}
        <div class="form-row justify-content-end mb-4">
            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text font-weight-bold">Total S/.</span>
                    </div>
                    <input type="text" class="form-control text-right" name="total" id="total" readonly>
                </div>
            </div>
        </div>

        {{-- Botones --}}
        <div class="form-row">
            <div class="col text-center">
                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> Registrar
                </button>
                <a href="{{ URL::to('ventas') }}" class="btn btn-danger">
                    <i class="fas fa-ban"></i> Cancelar
                </a>
            </div>
        </div>
    </form>
</div>
@endsection 

@section('js') 
    <script src="/assets/select2/bootstrap-select.min.js"></script>      
     <script src="/assets/calendario/js/bootstrap-datepicker.min.js"></script> 
     <script src="/assets/calendario/locales/bootstrap-datepicker.es.min.js"></script> 
     <script src="/archivos/js/createdoc.js"></script>      
@endsection 