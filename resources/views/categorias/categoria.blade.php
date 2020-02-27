@extends('layouts.app')
@section('content')
<h1 class="col m-5">Categoria</h1>
@if(session('mensaje'))
<div class='alert alert-success'>
{{session('mensaje')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<form action="{{route('categorias.insertar')}}" method="POST">
@csrf
@error('nombre')
<div class="alert alert-danger">
Se debe ingresar el nombre de la categoria
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="nombre" placeholder="Nombre Categoria" value="{{old('nombre')}}" class="form-control mb-2">
<button class="btn btn-primary btn-block" type="submit">Agregar</button>
</form>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Categoria</th>      
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach($obj_categorias as $categoria)
    <tr>
      <th scope="row">{{$categoria->categoria_id}}</th>
      <td>{{$categoria->nombre}}</td>      
    <td>
      <a href="{{route('categorias.editar',$categoria->categoria_id)}}" 
        class="btn btn-primary btn-sm">Edit</a>
      <form action="{{route('categorias.eliminar',$categoria->categoria_id)}}" method="POST" class="d-inline">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
    </form>
    </td>
    </tr>
  @endforeach()
  </tbody>
</table>
{{$obj_categorias->links()}}
@endsection