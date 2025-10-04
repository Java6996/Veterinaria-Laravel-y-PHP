@extends('partials.plantilla')

@section('header')
<div class="flex flex-col items-center justify-center gap-4 py-3">
    <!-- imagen y titulo -->
    <div class="flex items-center justify-center gap-3 text-center">
        <img src="{{ asset('/storage/imagenes/logo.png') }}" alt="Perfil" class="h-14">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ¡Bienvenidos al Gestor de Empleados!
        </h2>
    </div>

    <!-- Subtítulo motivacional -->
    <h3 class="text-sm sm:text-base text-gray-600 font-medium text-center px-4 max-w-xl">
        Tu trabajo impulsa nuestro éxito. ¡Gracias por tu esfuerzo diario!
    </h3>
</div>

@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-lg sm:rounded-lg p-6"
            style="background: linear-gradient(90deg, #e0f7fa 0%, #b2ebf2 100%);
                    border: 2px solid #06b6d4;">
            <div class="p-6 text-gray-900">
            <!-- Contenido principal  -->
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
                <!-- Bienvenida -->
                <div class="bg-white shadow-lg rounded-lg p-6 text-center my-16">
                    <h3 class="text-2xl font-bold text-cyan-600">¡Hola {{ Auth::user()->name ?? 'Empleado' }}! 👋</h3>
                    <p class="text-gray-600 text-sm mt-2">
                        Bienvenido al panel principal. Desde aquí podés acceder a tus funciones diarias, gestionar usuarios y revisar tu información.
                    </p>
                    <img src="{{ asset('/storage/imagenes/carousel1.jpg') }}" alt="imagen_vet" class="mx-auto h-60 mb-10">
                </div>

                <!-- accesos rapidos"" -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-10">
                <!-- Gestión de usuarios-->
                <div class="bg-white shadow-md rounded-lg p-5 text-center border border-gray-100 opacity-50 cursor-not-allowed">
                    <a href="{{ route('empleado.usuario') }}"
                            class="bg-white shadow-md hover:shadow-xl transition-all rounded-lg p-5 text-center border border-cyan-100">
                    <img src="{{ asset('/storage/imagenes/usuarios.png') }}" alt="Usuarios" class="mx-auto h-14 mb-4">
                        <div class="px-6">
                            <h4 class="text-lg font-semibold text-cyan-700 mb-1">Gestión de Usuarios</h4>
                            <p class="text-sm text-gray-500">Ver, crear y editar usuarios del sistema.</p>
                        </div>                                
                    </a>
                </div>

                <!-- Perfil  -->
                <div class="bg-white shadow-md rounded-lg p-5 text-center border border-gray-100 opacity-50 cursor-not-allowed">
                    <a href="{{ route('profile.edit') }}"
                            class="bg-white shadow-md hover:shadow-xl transition-all rounded-lg p-5 text-center border border-cyan-100">
                    <img src="{{ asset('/storage/imagenes/perfil.png') }}" alt="Perfil" class="mx-auto h-14 mb-4">
                        <div class="px-6">
                            <h4 class="text-lg font-semibold text-cyan-700"> Tu Perfil</h4>
                            <p class="text-sm text-gray-500 mt-1"> Editá tu información personal y contraseña.</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection