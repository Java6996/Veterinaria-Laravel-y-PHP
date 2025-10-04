@extends('partials.plantilla')

@section('header')
<div class="flex flex-col items-center justify-center gap-4 py-3">
    <!-- Imagen y título -->
    <div class="flex items-center justify-center gap-3 text-center">
        <img src="{{ asset('/storage/imagenes/logo.png') }}" alt="Logo" class="h-14">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ¡Bienvenido al Portal de Clientes!
        </h2>
    </div>

    <!-- Subtítulo enfocado en el usuario -->
    <h3 class="text-sm sm:text-base text-gray-600 font-medium text-center px-4 max-w-xl">
        Aquí podés consultar tus turnos, diagnósticos y el historial de tus mascotas. Estamos para cuidarte a vos y a tus mejores amigos.
    </h3>
</div>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-lg sm:rounded-lg p-6"
            style="background: linear-gradient(90deg, #e0ffe0 0%, #f0fff0 100%);
                    border: 2px solid #22c55e;">
            <div class="p-6 text-gray-900">
            <!-- Contenido principal  -->
                    <section class="mb-6">
                        <h1 class="font-bold text-3xl text-gray-900 mb-4">Bienvenido al panel principal de la veterinaria Amigos son los Amigos</h1>
                        <p class="text-gray-700">Aca es donde podras ver toda la informacion respecto a tus mascotas</p>
                    </section>
                    <h2 class="font-bold">¿Que podes gestionar?</h2>
                    <div>
                        <p>Nuestro objetivo es brindarte acceso rápido y seguro a todos los datos importantes sobre tus queridos compañeros.</p>
                    </div>
                    <div>
                        <p>En este panel, podrás:</p>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                Ver el historial médico de tus mascotas.
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Programar citas con nuestros veterinarios.
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-yellow-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 1.343-3 3 0 1.657 1.343 3 3 3s3-1.343 3-3c0-1.657-1.343-3-3-3zm0 0V4m0 7v7"/>
                                </svg>
                                Acceder a recomendaciones de cuidado y alimentación.
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 7.165 6 9.388 6 12v2.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                Estamos trabajando para que, en un futuro, tambien puedas recibir notificaciones sobre vacunaciones y tratamientos.
                            </li>
                        </ul>
                    </div>


                    <div class="font-extrabold text-2xl text-center text-indigo-700 mb-6">
                        Estamos comprometidos a brindarte la mejor experiencia posible y a garantizar que tus mascotas reciban la atención que merecen.<br>
                        Si tienes alguna pregunta o necesitas asistencia, no dudes en ponerte en contacto con nuestro equipo.
                    </div>

                        <div style="position: relative; width: 100%; height: 120px; overflow: hidden; margin: 20px 0;">
                            <img 
                                src="{{ asset('/storage/imagenes/gato_animado.gif') }}" 
                                alt="Veterinaria Amigos son los Amigos"
                                id="gato-corriendo"
                                style="position: absolute; left: 0; top: 0; height: 100px;"
                            >
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const gato = document.getElementById('gato-corriendo');
                                const container = gato.parentElement;
                                let pos = 0;
                                let direction = 1;
                                let lastContainerWidth = container.offsetWidth;

                                function animateCat() {
                                    const max = container.offsetWidth - gato.offsetWidth;
                                    // Ajustar la posición si el ancho del contenedor cambia (responsive)
                                    if (container.offsetWidth !== lastContainerWidth) {
                                        pos = Math.min(pos, max);
                                        lastContainerWidth = container.offsetWidth;
                                    }
                                    pos += direction * 3;
                                    if (pos >= max || pos <= 0) {
                                        direction *= -1;
                                        gato.style.transform = direction === 1 ? 'scaleX(1)' : 'scaleX(-1)';
                                    }
                                    gato.style.left = pos + 'px';
                                    requestAnimationFrame(animateCat);
                                }

                                // Ajustar el tamaño del gif y contenedor para pantallas pequeñas
                                function resizeCat() {
                                    if (window.innerWidth < 480) {
                                        gato.style.height = '40px';
                                        container.style.height = '50px';
                                    } else if (window.innerWidth < 640) {
                                        gato.style.height = '60px';
                                        container.style.height = '70px';
                                    } else {
                                        gato.style.height = '100px';
                                        container.style.height = '120px';
                                    }
                                }

                                window.addEventListener('resize', resizeCat);
                                resizeCat();
                                animateCat();
                            });
                        </script>
                        <div class="text-center font-extrabold text-3xl text-pink-600 mt-8 mb-4 drop-shadow-lg animate-pulse">
                            ¡Gracias por ser parte de nuestra comunidad de amantes de los animales!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection