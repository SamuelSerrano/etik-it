@extends('layouts.app')
@section('content')
<h1>Editar Producto</h1>
@if(session('mensaje'))
    <div class='alert alert-success'>
        {{session('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<form action="{{route('productos.update', $obj_productos[0]->producto_id)}}" method="POST">
    @csrf
    @method('PUT')
    @error('nombre')
<div class="alert alert-danger">
Se debe ingresar el nombre del producto
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
@error('lote')
<div class="alert alert-danger">
Se debe ingresar el lote del producto
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
@error('categoria_id')
<div class="alert alert-danger">
Se debe seleccionar una categoria.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror

    <input type="text" name="nombre" placeholder="Nombre" value="{{$obj_productos[0]->nombre}}" class="form-control mb-2">
    <input type="text" name="lote" placeholder="Lote" value="{{$obj_productos[0]->lote}}" class="form-control mb-2">
    <div class="form-check">
        <input type="checkbox" class="switch-input" name="activo" value="1" {{$obj_productos[0]->activo ? 'checked="checked"' : '0'}} />
        <label class="form-check-label" for="activo">Activo?</label>
      </div>
    <div class="form-group">
        <select name="categoria_id" placeholder="Categoria" class="form-control">
            @foreach($obj_categorias as $categoria)
                @if($categoria->categoria_id == $obj_productos[0]->categoria_id)
                    <option value="{{$categoria->categoria_id}}" selected>{{$categoria->nombre}}</option>
                @else
                    <option value="{{$categoria->categoria_id}}">{{$categoria->nombre}}</option>
                @endif
            @endforeach
        </select>
    </div>    
    <button class="btn btn-primary btn-block" type="submit">Editar</button>
</form>
@endsection