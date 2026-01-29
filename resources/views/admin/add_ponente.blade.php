@extends('layouts.admin')
@section('contenido')
    <div class="flex justify-center items-center">
        <form method="post" enctype="application/x-www-form-urlencoded"
            class="w-lg max-w-lg shadow-xl shadow-gray-300 p-4 border border-gray-300">
            @csrf
            <legend class="text-2xl font-bold text-gray-700 text-center p-4">Agregando ponente</legend>
            <div class="flex flex-col">
                <label class="text-lg text-gray-900 font-semibold mt-4 mb-2" for="ponente">
                    Ponente
                </label>
                <select class="p-2 text-lg text-gray-800  border-2 border-amber-600 rounded-sm" name="ponente" id="ponente">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->paternal_surname }} {{ $user->maternal_surname }} {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('ponente')
                    <p class="text-red-500 text-lg">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="flex flex-col">
                <label class="text-lg text-gray-900 font-semibold mt-4 mb-2" for="ponencia">
                    Ponencia:
                </label>
                <input type="text" placeholder="Titulo de la ponencia" name="ponencia" id="ponencia"
                    class="p-2 text-lg text-gray-800  border-2 border-amber-600 rounded-sm">
                @error('ponencia')
                    <p class="text-red-500 text-lg">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="text-center mt-4">
                <button type="submit"
                    class="p-2 bg-blue-500 text-white border-2 rounded-sm border-blue-600 hover:bg-blue-600 cursor-pointer">
                    Agregar Ponente
                </button>
            </div>
        </form>
    </div>
@endsection
