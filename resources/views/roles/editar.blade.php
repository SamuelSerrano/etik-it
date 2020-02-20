@extends('layouts.app')
@section('content')
<h1>Editar Role</h1>
@if(session('mensaje'))
    <div class='alert alert-success'>
        {{session('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<form action="{{route('roles.update', $obj_role->role_id)}}" method="POST">
    @csrf
    @method('PUT')
    @error('role')
    <div class="alert alert-danger">
    Se debe ingresar el nombre del role
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @enderror
    <input type="text" name="role" placeholder="Nombre Role" value="{{$obj_role->role}}" class="form-control mb-2">
    <button class="btn btn-primary btn-block" type="submit">Editar</button>
</form>
@endsection