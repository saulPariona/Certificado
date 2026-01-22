@extends('layouts.admin')
@section('contenido')
    <form method="post">
        @csrf
        <!-- esto es para que el formulario sea seguro, es como un token que se genera para que el formulario sea seguro-->
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Ingrese su email">
            <!--el placeholder es para que el usuario sepa que debe ingresar-->
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Ingrese su contraseña">
            <!--el placeholder es para que el usuario sepa que debe ingresar-->
        </div>
        <input type="submit" value="Ingresar">
    </form>
@endsection
