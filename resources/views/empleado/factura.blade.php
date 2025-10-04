@extends('partials.plantilla')

@section('header')
    <div class="flex flex-col items-center justify-center gap-4 py-3">
        <!-- Fila: imagen + título -->
        <div class="flex items-center justify-center gap-4">
            <img src="{{ asset('/storage/imagenes/factura.png') }}" alt="Perfil" class="h-14">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('¡Aquí están las facturas registradas!') }}
            </h2>
        </div>

        <!-- Botón de agregar nueva factura -->
        <a href="{{ route('empleado.facturas.create') }}"
            class="flex items-center gap-2 font-semibold px-5 py-2.5 rounded-lg shadow-md transition duration-200 transform hover:-translate-y-0.5"
            style="background-color: #06b6d4;"
            onmouseover="this.style.backgroundColor='#0891b2'"
            onmouseout="this.style.backgroundColor='#06b6d4'">
            <img src="{{ asset('/storage/imagenes/agregar-factura.png') }}" alt="Perfil" class="h-4">
            Agregar Factura
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
                        <input type="text" id="searchInput" placeholder="Buscar facturas por cliente, estado, monto o email..." 
                               class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <button onclick="buscarFacturas()" 
                                class="px-4 py-2 bg-white text-cyan-600 rounded-md hover:bg-gray-100 transition font-semibold">
                            Buscar
                        </button>
                        <button onclick="limpiarBusqueda()" 
                                class="px-4 py-2 bg-white text-gray-600 rounded-md hover:bg-gray-100 transition font-semibold">
                            Limpiar
                        </button>
                    </div>
                </div>
                
                <table class="empleado-table" id="facturasTable">
                    <thead>
                        <tr>
                            <th>Nro de Factura</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Cliente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($facturas as $factura)
                        <tr>
                            <td>{{ $factura->id }}</td>
                            <td>{{ $factura->fecha_emision }}</td>
                            <td>${{ number_format($factura->monto, 2) }}</td>
                            <td>
                                @if(strtolower($factura->estado_pago) === 'pagado')
                                    <span class="estado-pagado">
                                        {{ ucfirst($factura->estado_pago) }}
                                    </span>
                                @else
                                    <span class="estado-pendiente">
                                        {{ ucfirst($factura->estado_pago) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($factura->user)
                                    {{ $factura->user->name }}
                                @else
                                    Cliente no encontrado
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center justify-center gap-4">
                                    <a href="{{ route('empleado.facturas.edit', $factura->id) }}"
                                    class="px-3 py-1 rounded text-sm transition text-white"
                                    style="background-color: #06b6d4;"
                                    onmouseover="this.style.backgroundColor='#0891b2'"
                                    onmouseout="this.style.backgroundColor='#06b6d4'">
                                        Editar
                                    </a>

                                    <form action="{{ route('empleado.facturas.destroy', $factura->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar esta factura?')">
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
                                No tienes Facturas registradas.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script>
    function buscarFacturas() {
        const query = document.getElementById('searchInput').value;
        if (!query.trim()) {
            alert('Por favor ingresa un término de búsqueda');
            return;
        }
        
        fetch(`/empleado/buscar-facturas?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                actualizarTablaFacturas(data);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al buscar facturas');
            });
    }
    
    function actualizarTablaFacturas(facturas) {
        const tbody = document.querySelector('#facturasTable tbody');
        tbody.innerHTML = '';
        
        if (facturas.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="6" style="text-align:center; color:#06b6d4; font-style:italic;">
                        No se encontraron facturas con ese criterio de búsqueda.
                    </td>
                </tr>
            `;
            return;
        }
        
        facturas.forEach(factura => {
            const estadoClass = factura.estado_pago.toLowerCase() === 'pagado' ? 'estado-pagado' : 'estado-pendiente';
            const montoFormateado = new Intl.NumberFormat('es-AR', {
                style: 'currency',
                currency: 'ARS'
            }).format(factura.monto);
            
            const row = `
                <tr>
                    <td>${factura.id}</td>
                    <td>${factura.fecha_emision}</td>
                    <td>${montoFormateado}</td>
                    <td>
                        <span class="${estadoClass}">
                            ${factura.estado_pago.charAt(0).toUpperCase() + factura.estado_pago.slice(1)}
                        </span>
                    </td>
                    <td>${factura.user ? factura.user.name : 'Cliente no encontrado'}</td>
                    <td>
                        <div class="flex items-center justify-center gap-4">
                            <a href="/empleado/facturas/${factura.id}/edit"
                            class="px-3 py-1 rounded text-sm transition text-white"
                            style="background-color: #06b6d4;"
                            onmouseover="this.style.backgroundColor='#0891b2'"
                            onmouseout="this.style.backgroundColor='#06b6d4'">
                                Editar
                            </a>

                            <form action="/empleado/facturas/${factura.id}" method="POST"
                                  onsubmit="return confirm('¿Seguro que deseas eliminar esta factura?')">
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
            buscarFacturas();
        }
    });
    </script>
@endsection
