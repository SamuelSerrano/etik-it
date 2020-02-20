@extends('layouts.app')
@section('content')
<h1 class="col m-5">Cliente</h1>
@if(session('mensaje'))
<div class='alert alert-success'>
{{session('mensaje')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<form action="{{route('clientes.insertar')}}" method="POST">
@csrf
@error('nombre')
<div class="alert alert-danger">
Se debe ingresar el nombre del cliente
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="nombre" placeholder="Nombre Cliente" value="{{old('nombre')}}" class="form-control mb-2">
<div class="form-check">
    <input type="checkbox" class="switch-input" name="activo" value="1" {{old('activo') ? 'checked="checked"' : '0'}} />
    <label class="form-check-label" for="activo">Activo?</label>
  </div>


<button class="btn btn-primary btn-block" type="submit">Agregar</button>
</form>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nombre</th> 
      <th scope="col">Activo</th>     
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach($obj_clientes as $cliente)
    <tr>
      <th scope="row">{{$cliente->cliente_id}}</th>
      <td>{{$cliente->nombre}}</td>
      <td>{{$cliente->activo}}</td>               
    <td>
      <a href="{{route('clientes.editar',$cliente->cliente_id)}}" 
        class="btn btn-primary btn-sm">Edit</a>
      <form action="{{route('clientes.eliminar',$cliente->cliente_id)}}" method="POST" class="d-inline">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
    </form>
    </td>
    </tr>
  @endforeach()
  </tbody>
</table>
{{$obj_clientes->links()}}
@endsection