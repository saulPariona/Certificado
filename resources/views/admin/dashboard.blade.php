@extends('layouts.admin')
@section('contenido')
    <div class="flex flex-col items-stretch">
        <h1 class="text-3xl uppercase text-gray-900 text-center text-shadow-xs font-bold ">Bienvenidos al panel de
            administracion
        </h1>
        <div class="text-right m-3">
            <a class="p-2 bg-blue-500 text-white rounded-md cursor-pointer hover:bg-blue-600  border-2 border-blue-700 text-md"
                href="{{ route('add-evento') }}">Agregar evento</a>
        </div>
        <ul class="flex flex-col items-stretch px-4">
            @foreach ($eventos as $evento)
                <li class="my-3 border-b-4 border-blue-700 w-full border-l-4"><a
                        class=" block w-full text-md text-gray-700 font-semibold"
                        href="{{ route('evento', ['evento_id' => $evento->id]) }}">{{ $evento->name }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
