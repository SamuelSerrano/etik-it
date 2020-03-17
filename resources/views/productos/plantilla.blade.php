@extends('layouts.app')
@section('content')
<h2>Archivo CSV creado con éxito!!!</h2>
<a href="{{ asset('files_csv/'.$nombre_archivo) }}">Descarga Ahora</a>
@endsection