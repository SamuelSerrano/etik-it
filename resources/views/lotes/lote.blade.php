
@extends('layouts.app')
@section('content')
<h1 class="col m-5">Lote</h1>
@if(session('mensaje'))
<div class='alert alert-success'>
{{session('mensaje')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<form action="{{route('lotes.insertar')}}" method="POST">
@csrf


<input type="text" name="lote" placeholder="Lote" value="{{old('lote')}}" class="form-control mb-2">
@error('lote')
<div class="alert alert-danger">
Se debe ingresar el valor del lote
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="cantidad" placeholder="Cantidad" value="{{old('cantidad')}}" class="form-control mb-2">
@error('cantidad')
<div class="alert alert-danger">
Se debe ingresar un valor válido.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<div class="form-group">
  <label for="fechaVencimiento" class="form-check-label">Fecha Vencimiento</label>
<input type="date" name="fechaVencimiento" value="{{old('fechaVencimiento')}}" class="form-control">
</div>
@error('fechaVencimiento')
<div class="alert alert-danger">
Se debe ingresar una fecha válida.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<div class="form-group">
    <select name="producto_id" placeholder="Producto" class="form-control">
        <option value="" hidden>Seleccione un Producto</option>
        @foreach($obj_productos as $producto)
        <option value="{{$producto->producto_id}}"
                       {{ (collect(old('producto_id'))->contains($producto->producto_id)) ? 'selected':'' }}>
                       {{$producto->nombre}}
        </option>
        @endforeach
    </select>
    @error('producto_id')
<div class="alert alert-danger">
Se debe seleccionar un producto.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
</div>

<button class="btn btn-primary btn-block" type="submit">Agregar</button>
</form>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Lote</th>   
      <th scope="col">Producto</th>
      <th scope="col">Fecha Registro</th> 
      <th scope="col">Fecha Vencimiento</th> 
      <th scope="col">Cantidad</th>   
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach($obj_lotes as $lote)
    <tr>
      <th scope="row">{{$lote->lote_id}}</th>
      <td>{{$lote->lote}}</td>
      <td>{{$lote->producto}}</td>
      <td>{{$lote->fechaRegistro}}</td>
      <td>{{$lote->fechaVencimiento}}</td> 
      <td>{{$lote->cantidad}}</td>            
    <td>
      <a href="{{route('lotes.editar',$lote->lote_id)}}" 
        class="btn btn-primary btn-sm">Edit</a>
      <form action="{{route('lotes.eliminar',$lote->lote_id)}}" method="POST" class="d-inline">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
    </form>
    </td>
    </tr>
  @endforeach()
  </tbody>
</table>
{{$obj_lotes->links()}}
@endsection 
