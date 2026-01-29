@extends('layouts.admin')
@section('contenido')
    <div class="w-full h-full flex justify-center items-center bg-gray-200">

        <form method="post" class="p-5 border border-gray-400 rounded-md shadow-md shadow-gray-400 bg-white w-6/12 max-w-lg">
            <h2 class="text-2xl text-gray-700 font-bold text-center">Iniciar sesión</h2>
            <hr class="my-3 border-gray-400 border">
            <!-- el p es separa entre componentes dentro del formulario y el m es para separar entre componentes-->
            @csrf
            @isset($error)
                <!-- verifica si existe la variable error y si existe la muestra-->
                <p class="text-red-500 text-md font-semibold">{{ $error }}</p>
            @endisset
            <!-- esto es para que el formulario sea seguro, es como un token que se genera para que el formulario sea seguro-->
            <div class="p-3 w-full flex flex-col items-stretch">
                <label class="text-md text-gray-700 font-bold" for="email">Email</label>
                <input class="p-1 text-sm border rounded-sm border-gray-500" type="text" value="{{ old('email') }}"
                    name="email" id="email" placeholder="Ingrese su email">
                @error('email')
                    <p class="text-red-500 text-md font-semibold">{{ $message }}</p>
                @enderror
                <!-- old() es para que se muestre el valor que se ingreso en el formulario aunque falle el login-->
                <!--el placeholder es para que el usuario sepa que debe ingresar-->
            </div>
            <div class="p-3 w-full flex flex-col items-stretch">
                <label class="text-md text-gray-700 font-bold" for="password">Password</label>
                <input class="p-1 text-sm border border-gray-500 rounded-sm" type="password" value="{{ old('password') }}"
                    name="password" id="password" placeholder="Ingrese su contraseña">
                @error('password')
                    <p class="text-red-500 text-md font-semibold">{{ $message }}</p>
                @enderror
                <!-- old() es para que se muestre el valor que se ingreso en el formulario aunque falle el login-->
                <!--el placeholder es para que el usuario sepa que debe ingresar-->
            </div>
            <div class="text-center">
                <input type="submit" value="Ingresar"
                    class="m-3 text-sm uppercase bg-blue-500 text-white p-2 rounded-sm cursor-pointer hover:bg-blue-600  border-2 border-blue-700">
            </div>
        </form>
    </div>
@endsection
