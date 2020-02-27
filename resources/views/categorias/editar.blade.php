@extends('layouts.app')
@section('content')
<h1>Editar Categoria</h1>
@if(session('mensaje'))
    <div class='alert alert-success'>
        {{session('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<form action="{{route('categorias.update', $obj_categoria->categoria_id)}}" method="POST">
    @csrf
    @method('PUT')
    @error('nombre')
    <div class="alert alert-danger">
    Se debe ingresar el nombre de la categoria
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @enderror
    <input type="text" name="nombre" placeholder="Nombre Categoria" value="{{$obj_categoria->nombre}}" class="form-control mb-2">
    <button class="btn btn-primary btn-block" type="submit">Editar</button>
</form>
@endsection