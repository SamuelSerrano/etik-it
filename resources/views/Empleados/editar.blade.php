@extends('layouts.app')
@section('content')
<h1>Editar Empleado</h1>
@if(session('mensaje'))
    <div class='alert alert-success'>
        {{session('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<form action="{{route('empleados.update', $obj_empleados[0]->empleado_id)}}" method="POST">
    @csrf
    @method('PUT')
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
    <input type="text" name="name" placeholder="Nombre" value="{{$obj_empleados[0]->name}}" class="form-control mb-2">
    <input type="text" name="email" placeholder="Correo" value="{{$obj_empleados[0]->email}}" class="form-control mb-2">
    <!--<input type="password" name="password"placeholder="Password" class="form-control mb-2">-->
    <input type=hidden name="hd_password" value="{{$obj_empleados[0]->password}}" >
    <div class="form-group">
        <select name="role_id" placeholder="Role" class="form-control">
            @foreach($obj_roles as $role)
                @if($role->role_id == $obj_empleados[0]->role_id)
                    <option value="{{$role->role_id}}" selected>{{$role->role}}</option>
                @else
                    <option value="{{$role->role_id}}">{{$role->role}}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <select name="cliente_id" placeholder="Cliente" class="form-control">
            @foreach($obj_clientes as $cliente)
                @if($cliente->cliente_id == $obj_empleados[0]->cliente_id)
                    <option value="{{$cliente->cliente_id}}" selected>{{$cliente->nombre}}</option>
                @else
                    <option value="{{$cliente->cliente_id}}">{{$cliente->nombre}}</option>
                @endif            
            @endforeach
        </select>
    </div>
    <button class="btn btn-primary btn-block" type="submit">Editar</button>
</form>
@endsection