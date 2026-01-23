@extends('layouts.admin')
@section('contenido')
    <h1>Bienvenidos al panel de administracion</h1>
    <ul>
        @foreach ($eventos as $evento)
            <li><a href="{{ route('evento', ['evento_id' => $evento->id]) }}">{{ $evento->name }}</a></li>
        @endforeach
    </ul>
@endsection
