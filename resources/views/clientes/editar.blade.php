@extends('layouts.app')
@section('content')
<h1>Editar Cliente</h1>
@if(session('mensaje'))
    <div class='alert alert-success'>
        {{session('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<form action="{{route('clientes.update', $obj_cliente->cliente_id)}}" method="POST">
    @csrf
    @method('PUT')
    @error('nombre')
    <div class="alert alert-danger">
    Se debe ingresar el nombre del cliente
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @enderror
    <input type="text" name="nombre" placeholder="Nombre Cliente" value="{{$obj_cliente->nombre}}" class="form-control mb-2">
    <div class="form-check">
        <input type="checkbox" class="switch-input" name="activo" value="1" {{$obj_cliente->activo ? 'checked="checked"' : '0'}} />
        <label class="form-check-label" for="activo">Activo?</label>
      </div>
    <button class="btn btn-primary btn-block" type="submit">Editar</button>
</form>
@endsection