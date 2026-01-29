@extends('layouts.admin')
@section('contenido')
    <a class="p-3 bg-purple-500 text-white my-2 inline-block" href="{{ route('dashboard') }}">Atras</a>

    <form action="{{ route('add-evento') }}" method="post"
        class="mx-auto w-10/12 min-w-md max-w-lg p-4 border border-gray-200 shadow-md">
        @csrf
        <legend class="text-2xl text-center py-4">Crear evento</legend>
        <div class="mb-4 flex flex-col items-stretch gap-2">
            <label class="text-md font-semibold" for="name">Nombre</label>
            <input class="p-3 border-2 border-orange-300 rounded-sm " required type="text" value="{{ old('name') }}"
                name="name" id="name" placeholder="Nombre del evento">
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4 flex flex-col items-stretch gap-2">
            <label class="text-md font-semibold" for="fecha">Fecha</label>
            <input class="p-3 border-2 border-orange-300 rounded-sm" required type="date" value="{{ old('fecha') }}"
                name="fecha" id="fecha" placeholder="Fecha del evento">
            @error('fecha')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4 flex flex-col items-stretch gap-2">
            <label class="text-md font-semibold" for="address">Direccion</label>
            <input class="p-3 border-2 border-orange-300 rounded-sm" type="text" value="{{ old('address') }}"
                name="address" id="address" placeholder="Direccion del evento">
        </div>
        <div class="mb-4 flex flex-col items-stretch gap-2">
            <label class="text-md font-semibold" for="url">Url</label>
            <input class="p-3 border-2 border-orange-300 rounded-sm" type="text" value="{{ old('url') }}"
                name="url" id="url" placeholder="URL del evento">
        </div>
        <div class="text-center">
            <button
                class="p-2 px-3 bg-blue-500 text-white rounded-sm border-2 border-blue-600 hover:bg-blue-600 cursor-pointer"
                type="submit">Crear</button>
        </div>
    </form>
@endsection
