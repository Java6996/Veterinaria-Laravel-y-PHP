@extends('partials.plantilla')

@section('header')
    <div class="flex flex-col items-center justify-center gap-4 py-3">
        <!-- Fila: imagen + título -->
        <div class="flex items-center justify-center gap-4">
            <img src="{{ asset('/storage/imagenes/informe-medico.png') }}" alt="Perfil" class="h-14">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('¡Aquí están los diagnósticos registrados!') }}
            </h2>
        </div>

        <!-- Botón de agregar diagnostico -->
        <a href="{{ route('empleado.diagnosticos.create') }}"
            class="flex items-center gap-2 font-semibold px-5 py-2.5 rounded-lg shadow-md transition duration-200 transform hover:-translate-y-0.5"
            style="background-color: #06b6d4;"
            onmouseover="this.style.backgroundColor='#0891b2'"
            onmouseout="this.style.backgroundColor='#06b6d4'">
            <img src="{{ asset('/storage/imagenes/agregar-diagnostico.png') }}" alt="Agregar Diagnóstico" class="h-4">
            Agregar Diagnóstico
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
                        <input type="text" id="searchInput" placeholder="Buscar diagnósticos por síntomas, diagnóstico, tratamiento o mascota..." 
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <button onclick="buscarDiagnosticos()" 
                                class="px-4 py-2 bg-white text-cyan-600 rounded-md hover:bg-gray-100 transition font-semibold">
                            Buscar
                        </button>
                        <button onclick="limpiarBusqueda()" 
                                class="px-4 py-2 bg-white text-gray-600 rounded-md hover:bg-gray-100 transition font-semibold">
                            Limpiar
                        </button>
                    </div>
                </div>
                
                <table class="empleado-table" id="diagnosticosTable">
                    <thead>
                        <tr>
                            <th>Nro Diagnóstico</th>
                            <th>Fecha de la consulta</th>
                            <th>Mascota</th>
                            <th>Síntomas</th>
                            <th>Diagnóstico</th>
                            <th>Tratamiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($diagnosticos as $diagnostico)
                            <tr>
                                <td>{{ $diagnostico->id }}</td>
                                <td>{{ $diagnostico->fecha }}</td>
                                <td>{{ $diagnostico->mascota->nombre ?? 'Mascota no encontrada' }}</td>
                                <td>{{ $diagnostico->sintomas }}</td>
                                <td>{{ $diagnostico->diagnostico }}</td>
                                <td>{{ $diagnostico->tratamiento }}</td>
                                <td>
                                    <div class="flex items-center justify-center gap-4">
                                        <a href="{{ route('empleado.diagnosticos.edit', $diagnostico->id) }}"
                                           class="px-3 py-1 rounded text-sm text-white transition"
                                           style="background-color: #06b6d4;"
                                           onmouseover="this.style.backgroundColor='#0891b2'"
                                           onmouseout="this.style.backgroundColor='#06b6d4'">
                                            Editar
                                        </a>

                                        <form action="{{ route('empleado.diagnosticos.destroy', $diagnostico->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Seguro que deseas eliminar este diagnóstico?')">
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
                                <td colspan="7" style="text-align:center; color:#06b6d4; font-style:italic;">
                                    No tienes Diagnósticos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function buscarDiagnosticos() {
    const query = document.getElementById('searchInput').value;
    if (!query.trim()) {
        alert('Por favor ingresa un término de búsqueda');
        return;
    }
    
    fetch(`/empleado/buscar-diagnosticos?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            actualizarTablaDiagnosticos(data);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al buscar diagnósticos');
        });
}

function actualizarTablaDiagnosticos(diagnosticos) {
    const tbody = document.querySelector('#diagnosticosTable tbody');
    tbody.innerHTML = '';
    
    if (diagnosticos.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" style="text-align:center; color:#06b6d4; font-style:italic;">
                    No se encontraron diagnósticos con ese criterio de búsqueda.
                </td>
            </tr>
        `;
        return;
    }
    
    diagnosticos.forEach(diagnostico => {
        const row = `
            <tr>
                <td>${diagnostico.id}</td>
                <td>${diagnostico.fecha}</td>
                <td>${diagnostico.mascota ? diagnostico.mascota.nombre : 'Mascota no encontrada'}</td>
                <td>${diagnostico.sintomas}</td>
                <td>${diagnostico.diagnostico}</td>
                <td>${diagnostico.tratamiento}</td>
                <td>
                    <div class="flex items-center justify-center gap-4">
                        <a href="/empleado/diagnosticos/${diagnostico.id}/edit"
                           class="px-3 py-1 rounded text-sm text-white transition"
                           style="background-color: #06b6d4;"
                           onmouseover="this.style.backgroundColor='#0891b2'"
                           onmouseout="this.style.backgroundColor='#06b6d4'">
                            Editar
                        </a>

                        <form action="/empleado/diagnosticos/${diagnostico.id}" method="POST"
                              onsubmit="return confirm('¿Seguro que deseas eliminar este diagnóstico?')">
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
        buscarDiagnosticos();
    }
});
</script>
@endsection
