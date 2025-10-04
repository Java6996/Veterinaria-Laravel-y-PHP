@extends('partials.plantilla')

@section('header')
    <div class="flex flex-col items-center justify-center gap-4 py-3">
        <!-- imagen + título -->
        <div class="flex items-center justify-center gap-4">
            <img src="{{ asset('/storage/imagenes/perro.png') }}" alt="Perfil" class="h-14">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('¡Aquí podras encontrar tus mascotas registradas!') }}
            </h2>
        </div>
    </div>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-lg sm:rounded-lg p-6"
            style="background: linear-gradient(90deg, #e0ffe0 0%, #f0fff0 100%);
                    border: 2px solid #22c55e;">
            <div class="p-6 text-gray-900">
                <table class="cliente-table">
                    <thead>
                        <tr>
                            <th>Nro identificacion mascota</th>
                            <th>Nombre</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Fecha de Nacimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($mascotas as $mascota)
                        <tr>
                            <td>{{ $mascota->id_mascota }}</td>
                            <td>
                                <span class="mascota-icon">
                                    @if(strtolower($mascota->especie) == 'perro')
                                        🐶
                                    @elseif(strtolower($mascota->especie) == 'gato')
                                        🐱
                                    @else
                                        🐾
                                    @endif
                                </span>
                                {{ $mascota->nombre }}
                            </td>
                            <td>{{ ucfirst($mascota->especie) }}</td>
                            <td>{{ ucfirst($mascota->raza) }}</td>
                            <td>{{ $mascota->fecha_nacimiento }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; color:#16a34a; font-style:italic;">
                                No tienes Mascotas registradas.
                            </td>
                        </tr>                    
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection