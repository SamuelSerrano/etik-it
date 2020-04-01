@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">    
        @foreach($obj_cola->chunk(50) as $chunk)
          @foreach($chunk as $item)
          {!! QrCode::size(150)
          ->errorCorrection('H')
          ->generate($item); !!}
          @endforeach
        @endforeach
    </div>
  </div>
<h2>Archivo CSV creado con éxito!!!</h2>
<a href="{{ asset('files_csv/'.$nombre_archivo) }}">Descarga Ahora</a>
@endsection