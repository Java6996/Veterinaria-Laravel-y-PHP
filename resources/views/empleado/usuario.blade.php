@extends('partials.plantilla')

@section('header')
    <div class="flex flex-col items-center justify-center gap-4 py-3">
        <!-- Fila: imagen + título -->
        <div class="flex items-center justify-center gap-4">
            <img src="{{ asset('/storage/imagenes/usuario.png') }}" alt="Perfil" class="h-14">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('¡Aquí están los usuarios registrados!') }}
            </h2>
        </div>

        <!-- Botón de agregar nuevo usaurio -->
        <a href="{{ route('empleado.usuarios.create') }}"
            class="flex items-center gap-2 font-semibold px-5 py-2.5 rounded-lg shadow-md transition duration-200 transform hover:-translate-y-0.5"
            style="background-color: #06b6d4;"
            onmouseover="this.style.backgroundColor='#0891b2'"
            onmouseout="this.style.backgroundColor='#06b6d4'">
            <img src="{{ asset('/storage/imagenes/agregar-usuario.png') }}" alt="Perfil" class="h-4">
            Agregar Usuario
        </a>
            </div>
        
        <script>
        function buscarUsuarios() {
            const query = document.getElementById('searchInput').value;
            if (!query.trim()) {
                alert('Por favor ingresa un término de búsqueda');
                return;
            }
            
            fetch(`/empleado/buscar-usuarios?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    actualizarTablaUsuarios(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al buscar usuarios');
                });
        }
        
        function actualizarTablaUsuarios(usuarios) {
            const tbody = document.querySelector('#usuariosTable tbody');
            tbody.innerHTML = '';
            
            if (usuarios.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" style="text-align:center; color:#16a34a; font-style:italic;">
                            No se encontraron usuarios con ese criterio de búsqueda.
                        </td>
                    </tr>
                `;
                return;
            }
            
            usuarios.forEach(user => {
                const row = `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.role.charAt(0).toUpperCase() + user.role.slice(1)}</td>
                        <td class="flex items-center justify-center gap-4">
                            <a href="/usuarios/${user.id}/editar"
                            class="px-3 py-1 rounded text-sm transition text-white"
                            style="background-color: #06b6d4;"
                            onmouseover="this.style.backgroundColor='#0891b2'"
                            onmouseout="this.style.backgroundColor='#06b6d4'">
                                Editar
                            </a>

                            <form action="/usuarios/${user.id}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        style="background-color: rgb(212, 47, 6);"
                                        class="text-white px-3 py-1 rounded text-sm transition"
                                        onmouseover="this.style.backgroundColor='rgb(170, 30, 5)'"
                                        onmouseout="this.style.backgroundColor='rgb(212, 47, 6)'">
                                    Eliminar
                                </button>
                            </form>
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
                buscarUsuarios();
            }
        });
        </script>
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
                        <input type="text" id="searchInput" placeholder="Buscar usuarios por nombre, email o rol..." 
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <button onclick="buscarUsuarios()" 
                                class="px-4 py-2 bg-white text-cyan-600 rounded-md hover:bg-gray-100 transition font-semibold">
                            Buscar
                        </button>
                        <button onclick="limpiarBusqueda()" 
                                class="px-4 py-2 bg-white text-gray-600 rounded-md hover:bg-gray-100 transition font-semibold">
                            Limpiar
                        </button>
                    </div>
                </div>
                
                <table class="empleado-table" id="usuariosTable">
                    <thead>
                        <tr>
                            <th>Nro. Usuario</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td class="flex items-center justify-center gap-4">
                                <a href="{{ route('empleado.usuarios.edit', $user->id) }}"
                                class="px-3 py-1 rounded text-sm transition text-white"
                                style="background-color: #06b6d4;"
                                onmouseover="this.style.backgroundColor='#0891b2'"
                                onmouseout="this.style.backgroundColor='#06b6d4'">
                                    Editar
                                </a>

                                <form action="{{ route('empleado.usuarios.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            style="background-color: rgb(212, 47, 6);"
                                            class="text-white px-3 py-1 rounded text-sm transition"
                                            onmouseover="this.style.backgroundColor='rgb(170, 30, 5)'"
                                            onmouseout="this.style.backgroundColor='rgb(212, 47, 6)'">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; color:#16a34a; font-style:italic;">
                                No tienes usuarios registrados.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection