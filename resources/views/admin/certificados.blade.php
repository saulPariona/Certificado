@extends('layouts.admin')
@section('contenido')
    <div class="flex flex-col items-stretch">
        <h2 class="text-3xl font-bold uppercase text-center pb-4">{{ $evento->name }}</h2>
        <div class="flex items-start justify-start">
            <a class="p-3 bg-purple-500 text-white my-2 inline-block"
                href="{{ route('evento', ['evento_id' => $evento_id]) }}">Atras</a>
        </div>

        <h3 class="text-lg uppercase font-bold p-3 bg-gray-200 text-center">Organizadores</h3>
        <div class="text-justify">
            <a class="inline-block p-2 bg-blue-500 text-white border-2 rounded-sm border-blue-600 hover:bg-blue-600 m-2"
                href="{{ route('generar-organizadores', ['evento_id' => $evento_id]) }}">Generar
                Certificados</a>
        </div>
        <div class="text-justify">
            <a class="inline-block p-2 bg-red-500 text-white border-2 rounded-sm border-red-600 hover:bg-red-600 m-2"
                href="{{ route('desacertificar-organizadores', ['evento_id' => $evento_id]) }}">Desacertificar</a>
        </div>


        <ul class="flex flex-col items-stretch">
            @foreach ($organizadores as $organizador)
                <li class="p-3 flex flex-nowrap">
                    <p class="text-md uppercase text-gray-900 grow">{{ $organizador->paternal_surname }} -
                        {{ $organizador->maternal_surname }}
                        -
                        {{ $organizador->name }} - {{ $organizador->email }} - {{ $organizador->dni }}</p>
                    @if ($organizador->pivot->certificado_creado)
                        @foreach ($certificados as $certificado)
                            @if ($certificado->tipo_id == 4 && $certificado->user_id == $organizador->id)
                                <a href="{{ route('documento', ['certificado_id' => $certificado->id]) }}" target="_blank"
                                    class="text-green-500 font-semibold p-2">Ver Certificado</a>
                                @break
                            @endif
                        @endforeach
                    @else
                        <span class="text-amber-500 font-semibold p-2">Certificado No Creado</span>
                    @endif
                </li>
            @endforeach
            @if ($organizadores->isEmpty())
                <!-- la funcion isEmpty() verifica si esta vacio y si esta vacio muestra el mensaje-->
                <li>No hay organizadores</li>
            @endif
        </ul>
        <h3 class="text-lg uppercase font-bold p-3 bg-gray-200 text-center">Ponentes</h3>
        <div class="text-justify">
            <a class="inline-block p-2 bg-blue-500 text-white border-2 rounded-sm border-blue-600 hover:bg-blue-600 m-2"
                href="{{ route('generar-ponentes', ['evento_id' => $evento_id]) }}">Generar
                Certificados</a>
        </div>
        <div class="text-justify">
            <a class="inline-block p-2 bg-red-500 text-white border-2 rounded-sm border-red-600 hover:bg-red-600 m-2"
                href="{{ route('desacertificar-ponentes', ['evento_id' => $evento_id]) }}">Desacertificar</a>
        </div>
        <ul class="flex flex-col items-stretch">
            @foreach ($ponentes as $ponente)
                <li class="p-4 flex flex-nowrap">
                    <div class=" flex flex-col items-stretch grow">
                        <p class="text-md uppercase text-gray-900 grow">{{ $ponente->paternal_surname }}
                            {{ $ponente->maternal_surname }}
                            {{ $ponente->name }} {{ $ponente->email }} {{ $ponente->dni }}</p>
                        <p class=" px-7 text-md uppercase text-gray-600 italic">{{ $ponente->pivot->ponencia }}</p>
                    </div>
                    <div class="flex items-center justify-center">
                        @if ($ponente->pivot->certificado_creado)
                            @foreach ($certificados as $certificado)
                                @if ($certificado->tipo_id == 3 && $certificado->user_id == $ponente->id)
                                    <a href="{{ route('documento', ['certificado_id' => $certificado->id]) }}"
                                        target="_blank" class="text-green-500 font-semibold p-2">Ver Certificado</a>
                                    @break
                                @endif
                            @endforeach
                        @else
                            <span class="text-amber-500 font-semibold p-2">Certificado No Creado</span>
                        @endif
                    </div>
                </li>
            @endforeach
            @if ($ponentes->isEmpty())
                <!-- la funcion isEmpty() verifica si esta vacio y si esta vacio muestra el mensaje-->
                <li>No hay ponentes</li>
            @endif
        </ul>
        <h3 class="text-lg uppercase font-bold p-3 bg-gray-200 text-center">Asistentes</h3>
        <div class="text-justify">
            <a class="inline-block p-2 bg-blue-500 text-white border-2 rounded-sm border-blue-600 hover:bg-blue-600 m-2"
                href="{{ route('generar-asistentes', ['evento_id' => $evento_id]) }}">Generar
                Certificados</a>
        </div>
        <div class="text-justify">
            <a class="inline-block p-2 bg-red-500 text-white border-2 rounded-sm border-red-600 hover:bg-red-600 m-2"
                href="{{ route('desacertificar-asistentes', ['evento_id' => $evento_id]) }}">Desacertificar</a>
        </div>


        <ul class="flex flex-col items-stretch">
            @foreach ($asistentes as $asistente)
                <li class="p-3 flex flex-nowrap">
                    <p class="text-md uppercase text-gray-900 grow">{{ $asistente->paternal_surname }} -
                        {{ $asistente->maternal_surname }}
                        -
                        {{ $asistente->name }} - {{ $asistente->email }} - {{ $asistente->dni }}</p>
                    @if ($asistente->pivot->certificado_creado)
                        @foreach ($certificados as $certificado)
                            @if ($certificado->tipo_id == 2 && $certificado->user_id == $asistente->id)
                                <a href="{{ route('documento', ['certificado_id' => $certificado->id]) }}" target="_blank"
                                    class="text-green-500 font-semibold p-2">Ver Certificado</a>
                                @break
                            @endif
                        @endforeach
                    @else
                        <span class="text-amber-500 font-semibold p-2">Certificado No Creado</span>
                    @endif
                </li>
            @endforeach
            @if ($asistentes->isEmpty())
                <!-- la funcion isEmpty() verifica si esta vacio y si esta vacio muestra el mensaje-->
                <li>No hay asistentes</li>
            @endif
        </ul>
    </div>
@endsection
