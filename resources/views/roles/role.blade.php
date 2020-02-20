@extends('layouts.app')
@section('content')
<h1 class="col m-5">Role</h1>
@if(session('mensaje'))
<div class='alert alert-success'>
{{session('mensaje')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<form action="{{route('roles.insertar')}}" method="POST">
@csrf
@error('role')
<div class="alert alert-danger">
Se debe ingresar el nombre del role
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="role" placeholder="Nombre Role" value="{{old('role')}}" class="form-control mb-2">
<button class="btn btn-primary btn-block" type="submit">Agregar</button>
</form>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Role</th>      
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach($obj_roles as $role)
    <tr>
      <th scope="row">{{$role->role_id}}</th>
      <td>{{$role->role}}</td>      
    <td>
      <a href="{{route('roles.editar',$role->role_id)}}" 
        class="btn btn-primary btn-sm">Edit</a>
      <form action="{{route('roles.eliminar',$role->role_id)}}" method="POST" class="d-inline">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
    </form>
    </td>
    </tr>
  @endforeach()
  </tbody>
</table>
{{$obj_roles->links()}}
@endsection