@extends('layouts.app')
@section('content')
<h1 class="col m-5">Producto</h1>
@if(session('mensaje'))
<div class='alert alert-success'>
{{session('mensaje')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<form action="{{route('productos.insertar')}}" method="POST">
@csrf


<input type="text" name="nombre" placeholder="Nombre" value="{{old('nombre')}}" class="form-control mb-2">
@error('nombre')
<div class="alert alert-danger">
Se debe ingresar el nombre del producto
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="descripcion" placeholder="Descripcion" value="{{old('descripcion')}}" class="form-control mb-2">
@error('descripcion')
<div class="alert alert-danger">
Se debe ingresar una descripción max(100) caracteres.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="url_fabricante" placeholder="Sitio Web" value="{{old('url_fabricante')}}" class="form-control mb-2">
@error('url_fabricante')
<div class="alert alert-danger">
Se debe ingresar una url válida.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<div class="form-check">
  <input type="checkbox" class="switch-input" name="activo" value="1" {{old('activo') ? 'checked="checked"' : '0'}} />
  <label class="form-check-label" for="activo">Activo?</label>
</div>
<div class="form-group">
    <select name="categoria_id" placeholder="Categoria" class="form-control">
        <option value="" hidden>Seleccione una categoria</option>
        @foreach($obj_categorias as $categoria)
        <option value="{{$categoria->categoria_id}}"
                       {{ (collect(old('categoria_id'))->contains($categoria->categoria_id)) ? 'selected':'' }}>
                       {{$categoria->nombre}}
        </option>
        @endforeach
    </select>
    @error('categoria_id')
<div class="alert alert-danger">
Se debe seleccionar una categoria.
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
      <th scope="col">Nombre</th>     
      <th scope="col">Categoria</th>     
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach($obj_productos as $producto)
    <tr>
      <th scope="row">{{$producto->producto_id}}</th>
      <td>{{$producto->nombre}}</td>
      <td>{{$producto->nombrecat}}</td>             
    <td>
      <a href="{{route('productos.editar',$producto->producto_id)}}" 
        class="btn btn-primary btn-sm">Edit</a>
      <form action="{{route('productos.eliminar',$producto->producto_id)}}" method="POST" class="d-inline">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
    </form>
    </td>
    </tr>
  @endforeach()
  </tbody>
</table>
{{$obj_productos->links()}}
@endsection