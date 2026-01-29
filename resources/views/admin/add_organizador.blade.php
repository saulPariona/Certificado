@extends('layouts.admin')
@section('contenido')
    <div class="flex justify-center items-center">
        <form method="post" enctype="application/x-www-form-urlencoded"
            class="w-lg max-w-lg shadow-xl shadow-gray-300 p-4 border border-gray-300">
            <!-- el enctype es para que se pueda enviar el formulario y el method es para que se pueda enviar el formulario application/x-www-form-urlencoded es para que se pueda enviar el formulario sin archivos hay mas como multipart/form-data que es para enviar archivos y text/plain que es para enviar texto-->
            @csrf
            <legend class="text-2xl font-bold text-gray-700 text-center p-4">Agregando organizador</legend>
            <div class="flex flex-col">
                <label class="text-lg text-gray-900 font-semibold mb-4" for="organizador">Organizador</label>

                <select class="p-2 text-lg text-gray-800  border-2 border-amber-600 rounded-sm" name="organizador"
                    id="organizador">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->paternal_surname }} {{ $user->maternal_surname }}
                            {{ $user->name }}</option>
                    @endforeach
                </select>
                @error('organizador')
                    <p class="text-red-500 text-lg">{{ $message }}</p>
                @enderror
            </div>
            <div class=" text-center">
                <button type="submit" class="my-4 p-2 bg-blue-500 text-white rounded-sm cursor-pointer">Agregar</button>
            </div>
        </form>
    </div>
@endsection
