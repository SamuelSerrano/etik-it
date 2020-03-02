@extends('layouts.app')
@section('content')
<h1 class="col m-5">Generar cola de Productos</h1>
@if(session('mensaje'))
<div class='alert alert-success'>
{{session('mensaje')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<form action="{{route('productos.generarCola')}}" method="POST">
@csrf
@error('cantidad')
<div class="alert alert-danger">
Se debe ingresar la cantidad de productos a generar QR.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
@error('producto_id')
<div class="alert alert-danger">
Se debe seleccionar un producto.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror

<input type="text" name="cantidad" placeholder="Cantidad del Lote" value="{{old('cantidad')}}" class="form-control mb-2">
<div class="form-group">
    <select name="producto_id" placeholder="Producto" class="form-control">
        <option value="" hidden>Seleccione Producto</option>
        @foreach($obj_productos as $producto)
        <option value="{{$producto->producto_id}}"
                       {{ (collect(old('producto_id'))->contains($producto->producto_id)) ? 'selected':'' }}>
                       {{$producto->nombre}}
        </option>
        @endforeach
    </select>
</div>

<button class="btn btn-primary btn-block" type="submit">Generar Cola</button>
</form>

@endsection