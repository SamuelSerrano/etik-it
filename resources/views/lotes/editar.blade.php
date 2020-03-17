@extends('layouts.app')
@section('content')
<h1>Editar Lote</h1>
@if(session('mensaje'))
    <div class='alert alert-success'>
        {{session('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<form action="{{route('lotes.update', $obj_lotes[0]->lote_id)}}" method="POST">
    @csrf
    @method('PUT')




    <input type="text" name="lote" placeholder="Lote" value="{{$obj_lotes[0]->lote}}" class="form-control mb-2">
    @error('lote')
    <div class="alert alert-danger">
    Se debe ingresar el nombre del lote
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    @enderror
    <input type="text" name="cantidad" placeholder="Cantidad" value="{{$obj_lotes[0]->cantidad}}" class="form-control mb-2">
    @error('cantidad')
    <div class="alert alert-danger">
    Se debe ingresar la cantidad del lote.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    @enderror
    <div class="form-group">
        <label for="fechaVencimiento">Fecha Vencimiento</label>
      <input type="date" name="fechaVencimiento" value="{{date('Y-m-d', strtotime($obj_lotes[0]->fechaVencimiento))}}" class="form-control mb-2">
      </div>
      @error('fechaVencimiento')
      <div class="alert alert-danger">
      Se debe ingresar una fecha válida.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @enderror
    <div class="form-group">
        <select name="producto_id" placeholder="Producto" class="form-control">
            @foreach($obj_productos as $producto)
                @if($producto->producto_id == $obj_lotes[0]->producto_id)
                    <option value="{{$producto->producto_id}}" selected>{{$producto->nombre}}</option>
                @else
                    <option value="{{$producto->producto_id}}">{{$producto->nombre}}</option>
                @endif
            @endforeach
        </select>
        @error('producto_id')
        <div class="alert alert-danger">
        Se debe seleccionar un producto.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        @enderror
    </div>    
    <button class="btn btn-primary btn-block" type="submit">Editar</button>
</form>
@endsection