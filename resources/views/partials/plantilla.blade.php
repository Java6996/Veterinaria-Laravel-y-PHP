<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Veterinaria</title>
    <link rel="icon" href="{{ asset('/storage/imagenes/favicon.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen flex flex-col">
    <div class="flex-1 flex flex-col">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif


        <!-- Page Content -->
        <main class="flex-1 relative">
            <div 
            class="absolute inset-0"
            style="
                background: url('{{ asset('/storage/imagenes/fondo.png') }}') center center / cover no-repeat;
                opacity: 0.3;
                z-index: 0;
            ">
            </div>
            <div class="relative z-10">
            @yield('content')
            </div>
        </main>
    </div>
    <footer class="bg-gray-800 text-white py-4 text-center">
        <div class="flex justify-center gap-4">
            <p class="mb-2 text-center">
                &copy; 2025 Veterinaria Amigos son los Amigos. Todos los derechos reservados.
            </p>
        </div>
        <div class="flex justify-center gap-4">
            <p>Si quieres obtener más información sobre nosotros, entra a nuestras <em>redes sociales</em></p>
        </div>
        
        <div class="flex justify-center gap-4">
            <a href="#" class="hover:opacity-75">
                <img src="{{ asset('/storage/imagenes/facebook.png') }}" alt="Facebook" width="24">
            </a>
            <a href="#" class="hover:opacity-75">
                <img src="{{ asset('/storage/imagenes/instagram.png') }}" alt="Instagram" width="24">
            </a>
            <a href="#" class="hover:opacity-75">
                <img src="{{ asset('/storage/imagenes/youtube.png') }}" alt="YouTube" width="24">
            </a>
        </div>
    </footer>
</body>
</html>
