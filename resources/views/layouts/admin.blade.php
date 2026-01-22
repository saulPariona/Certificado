<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <!-- aqui se coloca el idioma que esta en el .env-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>Administracion de certificados</h1>
        <p>FIS-UNCP</p>
    </header>
    <div>
        @yield('contenido')<!-- aqui se coloca el contenido que se va a mostrar el yield es para que se pueda mostrar el contenido de otra vista, es como un contenedor-->
    </div>
</body>

</html>
