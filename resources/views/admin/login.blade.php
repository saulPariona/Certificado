@extends('layouts.admin')
@section('contenido')
    <form method="post">
        @csrf
        @isset($error)
            <!-- verifica si existe la variable error y si existe la muestra-->
            <p>{{ $error }}</p>
        @endisset
        <!-- esto es para que el formulario sea seguro, es como un token que se genera para que el formulario sea seguro-->
        <div>
            <label for="email">Email</label>
            <input type="text" value="{{ old('email') }}" name="email" id="email" placeholder="Ingrese su email">
            @error('email')
                <p>{{ $message }}</p>
            @enderror
            <!-- old() es para que se muestre el valor que se ingreso en el formulario aunque falle el login-->
            <!--el placeholder es para que el usuario sepa que debe ingresar-->
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" value="{{ old('password') }}" name="password" id="password"
                placeholder="Ingrese su contraseña">
            @error('password')
                <p>{{ $message }}</p>
            @enderror
            <!-- old() es para que se muestre el valor que se ingreso en el formulario aunque falle el login-->
            <!--el placeholder es para que el usuario sepa que debe ingresar-->
        </div>
        <input type="submit" value="Ingresar">
    </form>
@endsection
