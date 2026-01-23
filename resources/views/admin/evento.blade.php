@extends('layouts.admin')
@section('contenido')
    <a href="{{ route('dashboard') }}">Regresar</a>
    <h2>Nombre del evento</h2>
    <p>{{ $evento->name }}</p>
    <h3>Fecha</h3>
    <p>{{ $evento->fecha }}</p>
    <h3>Ubicacion</h3>
    <p>{{ $evento->address }}</p>
    <h3>Horario</h3>
    <p>{{ $evento->horario }}</p>
    <h3>Organizadores</h3>
    <hr>
    <ul>
        @foreach ($organizadores as $organizador)
            <li>
                <p>{{ $organizador->paternal_surname }} {{ $organizador->maternal_surname }}
                    {{ $organizador->name }} {{ $organizador->email }} {{ $organizador->dni }}</p>
            </li>
        @endforeach
        @if ($organizadores->isEmpty())
            <!-- la funcion isEmpty() verifica si esta vacio y si esta vacio muestra el mensaje-->
            <li>No hay organizadores</li>
        @endif
    </ul>

    <h3>Ponentes</h3>
    <hr>
    <ul>
        @foreach ($ponentes as $ponente)
            <li>
                <p>{{ $ponente->paternal_surname }} {{ $ponente->maternal_surname }}
                    {{ $ponente->name }} {{ $ponente->email }} {{ $ponente->dni }}</p>
            </li>
        @endforeach
        @if ($ponentes->isEmpty())
            <!-- la funcion isEmpty() verifica si esta vacio y si esta vacio muestra el mensaje-->
            <li>No hay ponentes</li>
        @endif
    </ul>

    <h3>Asistentes</h3>
    <hr>
    <ul>
        @foreach ($asistentes as $asistente)
            <li>
                <p>{{ $asistente->paternal_surname }} {{ $asistente->maternal_surname }}
                    {{ $asistente->name }} {{ $asistente->email }} {{ $asistente->dni }}</p>
            </li>
        @endforeach
        @if ($asistentes->isEmpty())
            <!-- la funcion isEmpty() verifica si esta vacio y si esta vacio muestra el mensaje-->
            <li>No hay asistentes</li>
        @endif
    </ul>

    <h3>Pre inscritos</h3>
    <hr>
    <ul>
        @foreach ($pre_registrados as $pre_registrado)
            <li>
                <p>{{ $pre_registrado->paternal_surname }} {{ $pre_registrado->maternal_surname }}
                    {{ $pre_registrado->name }} {{ $pre_registrado->email }} {{ $pre_registrado->dni }}</p>
            </li>
        @endforeach
        @if ($pre_registrados->isEmpty())
            <!-- la funcion isEmpty() verifica si esta vacio y si esta vacio muestra el mensaje-->
            <li>No hay pre inscritos</li>
        @endif
    </ul>
@endsection
