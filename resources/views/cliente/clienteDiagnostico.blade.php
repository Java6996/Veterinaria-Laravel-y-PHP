@extends('partials.plantilla')

@section('header')
    <div class="flex flex-col items-center justify-center gap-4 py-3">
        <!-- Fila: imagen + título -->
        <div class="flex items-center justify-center gap-4">
            <img src="{{ asset('/storage/imagenes/informe-medico.png') }}" alt="Perfil" class="h-14">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('¡Aquí podras encontrar los diagnósticos de tus animales registrados!') }}
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
                            <th>Nro Diagnóstico</th>
                            <th>Mascota</th>
                            <th>Síntomas</th>
                            <th>Diagnóstico</th>
                            <th>Tratamiento</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($diagnosticos as $diagnostico)
                        <tr>
                            <td>{{ $diagnostico->id }}</td>
                            <td>
                                <span class="mascota-icon">
                                    @if($diagnostico->mascota)
                                        @if(strtolower($diagnostico->mascota->especie) == 'perro')
                                            🐶
                                        @elseif(strtolower($diagnostico->mascota->especie) == 'gato')
                                            🐱
                                        @else
                                            🐾
                                        @endif
                                    @endif
                                </span>
                                {{ $diagnostico->mascota->nombre ?? 'Mascota no encontrada' }}
                            </td>
                            <td>
                                @if($diagnostico->sintomas)
                                    <span title="{{ $diagnostico->sintomas }}">
                                        {{ Str::limit($diagnostico->sintomas, 50) }}
                                        @if(strlen($diagnostico->sintomas) > 50)
                                            <span class="text-green-600">...</span>
                                        @endif
                                    </span>
                                @else
                                    <span class="text-gray-500 italic">Sin síntomas registrados</span>
                                @endif
                            </td>
                            <td>
                                @if($diagnostico->diagnostico)
                                    <span title="{{ $diagnostico->diagnostico }}">
                                        {{ Str::limit($diagnostico->diagnostico, 50) }}
                                        @if(strlen($diagnostico->diagnostico) > 50)
                                            <span class="text-green-600">...</span>
                                        @endif
                                    </span>
                                @else
                                    <span class="text-gray-500 italic">Sin diagnóstico registrado</span>
                                @endif
                            </td>
                            <td>
                                @if($diagnostico->tratamiento)
                                    <span title="{{ $diagnostico->tratamiento }}">
                                        {{ Str::limit($diagnostico->tratamiento, 50) }}
                                        @if(strlen($diagnostico->tratamiento) > 50)
                                            <span class="text-green-600">...</span>
                                        @endif
                                    </span>
                                @else
                                    <span class="text-gray-500 italic">Sin tratamiento registrado</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($diagnostico->fecha)->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; color:#16a34a; font-style:italic;">
                                No tienes diagnósticos registrados. ¡Todo está saludable!
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection