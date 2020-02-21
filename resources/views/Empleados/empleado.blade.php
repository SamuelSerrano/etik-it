@extends('layouts.app')
@section('content')
<h1 class="col m-5">Empleado</h1>
@if(session('mensaje'))
<div class='alert alert-success'>
{{session('mensaje')}}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<form action="{{route('empleados.insertar')}}" method="POST">
@csrf
@error('name')
<div class="alert alert-danger">
Se debe ingresar el nombre del empleado
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
@error('email')
<div class="alert alert-danger">
Se debe ingresar correo válido del empleado
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
@error('password')
<div class="alert alert-danger">
Se debe ingresar el password del empleado. Con las siguientes reglas: <br>
Mínimo 6 cáracteres. <br>
Al menos una mayúscula. <br>
Al menos un número. <br>
Al menos un caracter especial.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
@error('role_id')
<div class="alert alert-danger">
Se debe seleccionar un role.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
@error('cliente_id')
<div class="alert alert-danger">
Se debe un cliente
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="name" placeholder="Nombre" value="{{old('name')}}" class="form-control mb-2">
<input type="text" name="email" placeholder="Correo" value="{{old('email')}}" class="form-control mb-2">
<input type="password" name="password" placeholder="Password" value="{{old('password')}}" class="form-control mb-2">
<div class="form-group">
    <select name="role_id" placeholder="Role" class="form-control">
        <option value="" hidden>Seleccione un role</option>
        @foreach($obj_roles as $role)
        <option value="{{$role->role_id}}"
                       {{ (collect(old('role_id'))->contains($role->role_id)) ? 'selected':'' }}>
                       {{$role->role}}
        </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <select name="cliente_id" placeholder="Cliente" class="form-control">
        <option value="" hidden>Seleccione un cliente</option>
        @foreach($obj_clientes as $cliente)
        <option value="{{$cliente->cliente_id}}" 
                  {{ (collect(old('cliente_id'))->contains($cliente->cliente_id)) ? 'selected':'' }}>
                  {{$cliente->nombre}}
        </option>
        @endforeach
    </select>
</div>


<button class="btn btn-primary btn-block" type="submit">Agregar</button>
</form>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nombre</th> 
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Cliente</th>     
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach($obj_empleados as $empleado)
    <tr>
      <th scope="row">{{$empleado->empleado_id}}</th>
      <td>{{$empleado->name}}</td>
      <td>{{$empleado->email}}</td> 
      <td>{{$empleado->role}}</td>
      <td>{{$empleado->nombre}}</td>              
    <td>
      <a href="{{route('empleados.editar',$empleado->empleado_id)}}" 
        class="btn btn-primary btn-sm">Edit</a>
      <form action="{{route('empleados.eliminar',$empleado->empleado_id)}}" method="POST" class="d-inline">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
    </form>
    </td>
    </tr>
  @endforeach()
  </tbody>
</table>
{{$obj_empleados->links()}}
@endsection