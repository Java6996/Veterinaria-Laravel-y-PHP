@extends('partials.plantilla')

@section('header')
    <div class="flex flex-col items-center justify-center gap-4 py-3">
        <!-- Fila: imagen + título -->
        <div class="flex items-center justify-center gap-4">
            <img src="{{ asset('/storage/imagenes/perro.png') }}" alt="Perfil" class="h-14">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('¡Aquí están las mascotas registradas!') }}
            </h2>
        </div>

        <!-- Botón de agregar nuevo usaurio -->
        <a href="{{ route('empleado.mascotas.create') }}"
            class="flex items-center gap-2 font-semibold px-5 py-2.5 rounded-lg shadow-md transition duration-200 transform hover:-translate-y-0.5"
            style="background-color: #06b6d4;"
            onmouseover="this.style.backgroundColor='#0891b2'"
            onmouseout="this.style.backgroundColor='#06b6d4'">
            <img src="{{ asset('/storage/imagenes/agregar-mascota.png') }}" alt="Perfil" class="h-4">
            Agregar Mascota
        </a>
    </div>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-lg sm:rounded-lg p-6"
            style="background: linear-gradient(90deg, #e0f7fa 0%, #b2ebf2 100%);
                    border: 2px solid #06b6d4;">
            <div class="p-6 text-gray-900">
                <!-- Mensajes -->
                <x-messages />
                
                <!-- Buscador -->
                <div class="mb-6 p-4 rounded-lg" style="background-color: #06b6d4;">
                    <div class="flex items-center gap-4">
                        <input type="text" id="searchInput" placeholder="Buscar mascotas por nombre, especie, raza o dueño..." 
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <button onclick="buscarMascotas()" 
                                class="px-4 py-2 bg-white text-cyan-600 rounded-md hover:bg-gray-100 transition font-semibold">
                            Buscar
                        </button>
                        <button onclick="limpiarBusqueda()" 
                                class="px-4 py-2 bg-white text-gray-600 rounded-md hover:bg-gray-100 transition font-semibold">
                            Limpiar
                        </button>
                    </div>
                </div>
                
                <table class="empleado-table" id="mascotasTable">
                    <thead>
                        <tr>
                            <th>Nro identificacion mascota</th>
                            <th>Nombre</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Dueño</th>
                            <th>Acciones</th>
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
                                <td>
                                    @if($mascota->user)
                                        {{ $mascota->user->name }}
                                    @else
                                        Sin dueño
                                    @endif  
                                <td>
                                    <div class="flex items-center justify-center gap-4">
                                        <a href="{{ route('empleado.mascotas.edit', $mascota->id_mascota) }}"
                                        class="px-3 py-1 rounded text-sm transition text-white"
                                        style="background-color: #06b6d4;"
                                        onmouseover="this.style.backgroundColor='#0891b2'"
                                        onmouseout="this.style.backgroundColor='#06b6d4'">
                                            Editar
                                        </a>

                                        <form action="{{ route('empleado.mascotas.destroy', $mascota->id_mascota) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Seguro que deseas eliminar esta mascota?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-white px-3 py-1 rounded text-sm transition"
                                                    style="background-color: rgb(212, 47, 6);"
                                                    onmouseover="this.style.backgroundColor='rgb(170, 30, 5)'"
                                                    onmouseout="this.style.backgroundColor='rgb(212, 47, 6)'">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center; color:#06b6d4; font-style:italic;">
                                    No tienes Mascota registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script>
    function buscarMascotas() {
        const query = document.getElementById('searchInput').value;
        if (!query.trim()) {
            alert('Por favor ingresa un término de búsqueda');
            return;
        }
        
        fetch(`/empleado/buscar-mascotas?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                actualizarTablaMascotas(data);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al buscar mascotas');
            });
    }
    
    function actualizarTablaMascotas(mascotas) {
        const tbody = document.querySelector('#mascotasTable tbody');
        tbody.innerHTML = '';
        
        if (mascotas.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align:center; color:#06b6d4; font-style:italic;">
                        No se encontraron mascotas con ese criterio de búsqueda.
                    </td>
                </tr>
            `;
            return;
        }
        
        mascotas.forEach(mascota => {
            const icono = mascota.especie.toLowerCase() === 'perro' ? '🐶' : 
                         mascota.especie.toLowerCase() === 'gato' ? '🐱' : '🐾';
            
            const row = `
                <tr>
                    <td>${mascota.id_mascota}</td>
                    <td>
                        <span class="mascota-icon">${icono}</span>
                        ${mascota.nombre}
                    </td>
                    <td>${mascota.especie.charAt(0).toUpperCase() + mascota.especie.slice(1)}</td>
                    <td>${mascota.raza.charAt(0).toUpperCase() + mascota.raza.slice(1)}</td>
                    <td>${mascota.fecha_nacimiento}</td>
                    <td>${mascota.user ? mascota.user.name : 'Sin dueño'}</td>
                    <td>
                        <div class="flex items-center justify-center gap-4">
                            <a href="/mascotas/${mascota.id_mascota}/editar"
                            class="px-3 py-1 rounded text-sm transition text-white"
                            style="background-color: #06b6d4;"
                            onmouseover="this.style.backgroundColor='#0891b2'"
                            onmouseout="this.style.backgroundColor='#06b6d4'">
                                Editar
                            </a>

                            <form action="/mascotas/${mascota.id_mascota}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta mascota?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-white px-3 py-1 rounded text-sm transition"
                                        style="background-color: rgb(212, 47, 6);"
                                        onmouseover="this.style.backgroundColor='rgb(170, 30, 5)'"
                                        onmouseout="this.style.backgroundColor='rgb(212, 47, 6)'">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    }
    
    function limpiarBusqueda() {
        document.getElementById('searchInput').value = '';
        location.reload();
    }
    
    // Búsqueda al presionar Enter
    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            buscarMascotas();
        }
    });
    </script>
@endsection