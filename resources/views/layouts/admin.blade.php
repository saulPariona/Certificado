<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> <!-- aqui se coloca el idioma que esta en el .env-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FIS-UNCP</title>
    @vite('resources/css/app.css')
</head>

<body class="w-full h-lvh flex flex-col items-stretch">
    <header class="p-2 bg-amber-400 shadow-md shadow-gray-400 ">
        <h1 class="text-2xl font-bold w-full text-center uppercase text-white px-9 ">Administracion de certificados</h1>
        <p class="m-1 text-center text-md font-bold text-white">FIS-UNCP</p>
        @auth
            <div class="w-full text-center">
                <a class=" m-4 text-white bg-red-500 border-2 border-red-600 cursor-pointer p-1 rounded-sm font-bold text-md md:absolute md:top-0 md:right-0 hover:bg-red-700"
                    href="{{ route('logout') }}">Cerrar
                    sesion</a><!-- aqui se coloca el enlace para cerrar sesion, si esta autenticado-->
            </div>
        @endauth
    </header>
    <div class="w-full py-4 grow">
        @yield('contenido')<!-- aqui se coloca el contenido que se va a mostrar el yield es para que se pueda mostrar el contenido de otra vista, es como un contenedor-->
    </div>
    <footer class="p-2 bg-amber-400 shadow-md shadow-gray-400 ">
        <p class="m-1 text-center text-md font-bold text-white">FIS-UNCP</p>
        <p class="m-1 text-center text-md font-bold text-white">@ {{ date('Y') }} - Todos los derechos reservados
        </p>
    </footer>
</body>

</html>
