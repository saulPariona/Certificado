@extends('layouts.admin')
@section('contenido')
    <a
        class="p-3 bg-purple-500 text-white my-2 inline-block"href="{{ route('evento', ['evento_id' => $evento_id]) }}">Atras</a>
    <form method="post" enctype="multipart/form-data"
        class="mx-auto w-10/12 min-w-md max-w-lg p-4 border border-gray-200 shadow-md">
        @csrf
        <legend class="text-2xl text-center py-4">Certificado base</legend>
        <div class="flex flex-col items-stretch">
            <label class="text-md font-semibold" for="base">Certificado base</label>
            <input class="p-3" required type="file" value="{{ old('base') }}" name="base" id="base"
                placeholder="Nombre del certificado base">
            @error('base')
                <p class="text-red-500 p-3 text-md">{{ $message }}</p>
            @enderror
        </div>
        <div class="text-center">
            <button
                class="p-2 px-3 bg-blue-500 text-white rounded-sm border-2 border-blue-600 hover:bg-blue-600 cursor-pointer"
                type="submit" class="m">Crear</button>
        </div>
    </form>
@endsection
