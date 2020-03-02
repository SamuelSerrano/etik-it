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
@endsection