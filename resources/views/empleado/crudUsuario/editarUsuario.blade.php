@extends('partials.plantilla')

@section('header')
<div class="flex flex-col items-center justify-center gap-4 py-3">
    <!-- Fila: imagen + título -->
    <div class="flex items-center justify-center gap-4">
        <img src="{{ asset('/storage/imagenes/editar-usuario.png') }}" alt="Perfil" class="h-14">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('¡Aquí podras editar el usuario seleccionado!') }}
        </h2>
    </div>
    <h3 class="text-sm sm:text-base text-gray-600 font-medium text-center px-4 max-w-xl">
        Podes cambiar el nombre, mail o password de tu usuario.
    </h3>
</div>
@endsection


@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-lg sm:rounded-lg p-6" style="background: linear-gradient(90deg, #e0f7fa 0%, #b2ebf2 100%);
                    border: 2px solid #06b6d4;">
            <div class="p-6 text-gray-900">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="max-w-md mx-auto py-6">
                            <!-- Mensajes -->
                            <x-messages />
                            
                            <form method="POST" action="{{ route('empleado.usuarios.update', $usuario->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block mb-1 text-gray-700">Nombre:</label>
                                    <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required
                                        class="w-full border border-sky-500 focus:border-sky-600 focus:ring-sky-500 p-2 mb-4 rounded">
                                </div>
                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block mb-1 text-gray-700">Email:</label>
                                    <input type="email" name="email" value="{{ old('email', $usuario->email) }}"
                                        required
                                        class="w-full border border-sky-500 focus:border-sky-600 focus:ring-sky-500 p-2 mb-4 rounded">
                                </div>
                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block mb-1 text-gray-700">Nueva Contraseña: <span
                                            class="text-sm text-gray-500">(dejar vacío para no cambiar)</span></label>
                                    <input type="password" name="password"
                                        class="w-full border border-sky-500 focus:border-sky-600 focus:ring-sky-500 p-2 mb-4 rounded">
                                </div>
                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block mb-1 text-gray-700">Rol:</label>
                                    <div class="mb-4 p-2 bg-gray-100 rounded text-gray-800">
                                        {{ ucfirst($usuario->role) }}</div>
                                    <input type="hidden" name="role" value="{{ $usuario->role }}">
                                </div>
                                <div class="flex flex-col gap-4 w-full">
                                    <div class="flex justify-center gap-4">
                                        <button type="submit" style="background-color: #06b6d4;"
                                            class="text-white px-4 py-2 rounded hover:opacity-90 transition">
                                            Actualizar
                                        </button>
                                        <button type="button"
                                            onclick="window.location='{{ route('empleado.usuario') }}'"
                                            style="background-color:rgb(212, 57, 6);"
                                            class="text-white px-4 py-2 rounded hover:opacity-90 transition">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection