@extends('layouts.admin')
@section('contenido')
    <div class="flex flex-col items-stretch">
        <h2 class="text-3xl font-bold uppercase text-center pb-4">{{ $evento->name }}</h2>
        <div class="flex items-start justify-start">
            <a class="p-3 bg-purple-500 text-white my-2 inline-block" href="{{ route('dashboard') }}">Atras</a>
        </div>
        <div class="py-3 px-4 my-4 w-full flex">
            @if ($evento->certificado_base != null)
                <a href="{{ route('admin-certificados', ['evento_id' => $evento_id]) }}"
                    class="text-lg font-bold text-center bg-blue-400 p-2 rounded-sm border-2 border-blue-600 text-white hover:bg-blue-600 self-start">Certificados</a>
            @endif
            <a href="{{ route('add-certificado-base', ['evento_id' => $evento_id]) }}"
                class="text-lg font-bold text-center bg-amber-400 p-2 rounded-sm border-2 border-amber-600 text-white hover:bg-amber-600 self-end ml-auto">Certificado
                base</a>
        </div>
        <h3 class="text-lg uppercase font-bold p-3 bg-gray-200 text-center">Organizadores</h3>
        <div class="text-justify">
            <a class="inline-block p-2 bg-blue-500 text-white border-2 rounded-sm border-blue-600 hover:bg-blue-600"
                href="{{ route('add-organizador', ['evento_id' => $evento_id]) }}">Agregar</a>
        </div>
        <ul class="flex flex-col items-stretch">
            @foreach ($organizadores as $organizador)
                <li class="p-3">
                    <p class="text-md uppercase text-gray-900">{{ $organizador->paternal_surname }} -
                        {{ $organizador->maternal_surname }}
                        -
                        {{ $organizador->name }} - {{ $organizador->email }} - {{ $organizador->dni }}</p>
                </li>
            @endforeach
            @if ($organizadores->isEmpty())
                <!-- la funcion isEmpty() verifica si esta vacio y si esta vacio muestra el mensaje-->
                <li>No hay organizadores</li>
            @endif
        </ul>
        <h3 class="text-lg uppercase font-bold p-3 bg-gray-200 text-center">Ponentes</h3>
        <div class="text-justify">
            <a class="inline-block p-2 bg-blue-500 text-white border-2 rounded-sm border-blue-600 hover:bg-blue-600"
                href="{{ route('add-ponente', ['evento_id' => $evento_id]) }}">Agregar</a>
        </div>
        <ul class="flex flex-col items-stretch">
            @foreach ($ponentes as $ponente)
                <li class="p-4">
                    <p class="text-md uppercase text-gray-900">{{ $ponente->paternal_surname }}
                        {{ $ponente->maternal_surname }}
                        {{ $ponente->name }} {{ $ponente->email }} {{ $ponente->dni }}</p>
                    <p class=" px-7 text-md uppercase text-gray-600 italic">{{ $ponente->pivot->ponencia }}</p>
                </li>
            @endforeach
            @if ($ponentes->isEmpty())
                <!-- la funcion isEmpty() verifica si esta vacio y si esta vacio muestra el mensaje-->
                <li>No hay ponentes</li>
            @endif
        </ul>
        <h3 class="text-lg uppercase font-bold p-3 bg-gray-200 text-center">Asistentes</h3>
        <div class="text-justify">
            <a class="inline-block p-2 bg-blue-500 text-white border-2 rounded-sm border-blue-600 hover:bg-blue-600"
                href="#">Agregar</a>
        </div>
        <ul class="flex flex-col items-stretch">
            @foreach ($asistentes as $asistente)
                <li class="p-4">
                    <p class="text-md uppercase text-gray-900">{{ $asistente->paternal_surname }}
                        {{ $asistente->maternal_surname }}
                        {{ $asistente->name }} {{ $asistente->email }} {{ $asistente->dni }}</p>
                </li>
            @endforeach
            @if ($asistentes->isEmpty())
                <!-- la funcion isEmpty() verifica si esta vacio y si esta vacio muestra el mensaje-->
                <li>No hay asistentes</li>
            @endif
        </ul>

        <h3 class="text-lg uppercase font-bold p-3 bg-gray-200 text-center">Pre inscritos</h3>
        <div class="text-justify">
            <a class="inline-block p-2 bg-blue-500 text-white border-2 rounded-sm border-blue-600 hover:bg-blue-600"
                href="#">Agregar</a>
        </div>
        <ul class="flex flex-col items-stretch">
            @foreach ($pre_registrados as $pre_registrado)
                <li class="p-4">
                    <p class="text-md uppercase text-gray-900">{{ $pre_registrado->paternal_surname }}
                        {{ $pre_registrado->maternal_surname }}
                        {{ $pre_registrado->name }} {{ $pre_registrado->email }} {{ $pre_registrado->dni }}</p>
                </li>
            @endforeach
            @if ($pre_registrados->isEmpty())
                <!-- la funcion isEmpty() verifica si esta vacio y si esta vacio muestra el mensaje-->
                <li>No hay pre inscritos</li>
            @endif
        </ul>
    </div>
@endsection
