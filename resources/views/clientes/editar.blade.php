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
    
    <input type="text" name="nombre" placeholder="Nombre Cliente" value="{{$obj_cliente->nombre}}" class="form-control mb-2">
    @error('nombre')
    <div class="alert alert-danger">
    Se debe ingresar el nombre del cliente
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @enderror
    <input type="text" name="razon_social" placeholder="Razón Social" value="{{$obj_cliente->razon_social}}" class="form-control mb-2">
@error('razon_social')
<div class="alert alert-danger">
Se debe ingresar la razón social del cliente
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="rep_legal" placeholder="Representante Legal" value="{{$obj_cliente->rep_legal}}" class="form-control mb-2">
@error('rep_legal')
<div class="alert alert-danger">
Se debe ingresar el representante legal del cliente
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="nit" placeholder="NIT" value="{{$obj_cliente->nit}}" class="form-control mb-2">
@error('nit')
<div class="alert alert-danger">
Se debe ingresar el NIT del cliente
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="direccion" placeholder="Dirección del Cliente" value="{{$obj_cliente->direccion}}" class="form-control mb-2">
@error('direccion')
<div class="alert alert-danger">
Se debe ingresar la dirección del cliente
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="tel_contacto" placeholder="Teléfono de Contacto" value="{{$obj_cliente->tel_contacto}}" class="form-control mb-2">
@error('tel_contacto')
<div class="alert alert-danger">
Se debe ingresar el teléfono de contacto del cliente
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="per_contacto" placeholder="Persona de Contacto" value="{{$obj_cliente->per_contacto}}" class="form-control mb-2">
@error('per_contacto')
<div class="alert alert-danger">
Se debe ingresar la persona de contacto del cliente
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="email_contacto" placeholder="Email de Contacto" value="{{$obj_cliente->email_contacto}}" class="form-control mb-2">
@error('email_contacto')
<div class="alert alert-danger">
Se debe ingresar un correo válido.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
<input type="text" name="email_alertas" placeholder="Email para Alertas" value="{{$obj_cliente->email_alertas}}" class="form-control mb-2">
@error('email_alertas')
<div class="alert alert-danger">
Se debe ingresar un correo válido.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@enderror
    <div class="form-check">
        <input type="checkbox" class="switch-input" name="activo" value="1" {{$obj_cliente->activo ? 'checked="checked"' : '0'}} />
        <label class="form-check-label" for="activo">Activo?</label>
      </div>
    <button class="btn btn-primary btn-block" type="submit">Editar</button>
</form>
@endsection