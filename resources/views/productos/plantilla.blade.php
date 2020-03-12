@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-5">    
      @foreach($obj_cola->chunk(50) as $chunk)
        @foreach($chunk as $item)
        <p>{{$item}}</p>
        @endforeach
      @endforeach
  </div>
</div>

@endsection