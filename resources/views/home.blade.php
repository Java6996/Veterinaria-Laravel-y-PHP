<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Veterinaria</title>
    <link rel="icon" href="{{ asset('/storage/imagenes/favicon.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="../css/estilos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
    <!-- Fonts -->

</head>

<body class="usuario"
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        <h1 class="home">Veterinaria Amigos Son Los Amigos</h1>
        @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth

            @php
            $role = Auth::user()->role ?? '';
            @endphp

            @if($role === 'empleado')
            <a href="{{ url('/empleado/dashboard') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Dashboard Empleado
            </a>
            @elseif($role === 'cliente')
            <a href="{{ url('/cliente/dashboard') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Dashboard Cliente
            </a>
            @else
            <!-- Fallback en caso de rol desconocido -->
            <a href="{{ url('/empleado/dashboard') }}"
                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                Inicio
            </a>
            @endif

        @else
            <a href="{{ route('login') }}" class="btn btn-outline-secondary bg-white text-dark border border-secondary rounded-pill px-4 py-2 hover-effect">
                Iniciar Sesión
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-outline-secondary bg-white text-dark border border-secondary rounded-pill px-4 py-2 hover-effect">
                    Registrarse
                </a>
            @endif

            @endauth
        </nav>
        @endif
    </header>
    <main class="container my-5 main-conteiner">
        <div class="container-fluid p-4 bg-white rounded shadow-sm mb-5">
            <h1 class="display-4 fw-bold">Cuidamos a tus mejores amigos</h1>
            <p class="lead text-center">Atención médica, peluquería, tienda de alimentos y accesorios. Todo en un solo
                lugar.</p>
        </div>
        <!-- Sección sobre la veterinaria -->
        <div class="container-fluid p-4 bg-white rounded shadow-sm mb-5">
            <div class="mb-3">
                <h2 class="text-center mb-4">¿Quiénes somos?</h2>
                <p class="text-center mb-5">
                    Somos una veterinaria comprometida con la salud y el bienestar de tus mascotas. Brindamos servicios
                    profesionales y productos de calidad con amor y responsabilidad.
                </p>
                <div class="row text-center">
                    <div class="col-md-4">
                        <h4>Consultas y vacunas</h4>
                        <p>Atención veterinaria general, vacunación y seguimiento clínico.</p>
                    </div>
                    <div class="col-md-4">
                        <h4>Tienda</h4>
                        <p>Alimentos balanceados, antiparasitarios, juguetes y más.</p>
                    </div>
                    <div class="col-md-4">
                        <h4>Peluquería</h4>
                        <p>Baños, cortes y tratamientos estéticos para perros y gatos.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Pie de página -->
    <footer class="bg-dark text-white text-center py-4">
        <p class="mb-2">&copy; 2025 Veterinaria Amigos son los Amigos. Todos los derechos reservados.</p>
        <div>
            <a href="#" class="text-white me-3"><img src="/storage/imagenes/facebook.png" alt="Facebook" width="24"></a>
            <a href="#" class="text-white me-3"><img src="/storage/imagenes/instagram.png" alt="Instagram"
                    width="24"></a>
            <a href="#" class="text-white"><img src="/storage/imagenes/youtube (1).png" alt="YouTube" width="24"></a>
        </div>
    </footer>

    @if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>