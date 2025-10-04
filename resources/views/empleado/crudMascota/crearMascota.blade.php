@extends('partials.plantilla')

@section('header')
<div class="flex flex-col items-center justify-center gap-4 py-3">
    <div class="flex items-center justify-center gap-4">
        <img src="{{ asset('/storage/imagenes/agregar-mascota.png') }}" alt="Perfil" class="h-14">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('¡Aquí podés agregar una nueva mascota!') }}
        </h2>
    </div>
    <h3 class="text-sm sm:text-base text-gray-600 font-medium text-center px-4 max-w-xl">
        Completá el formulario con los datos solicitados ¡Y listo!
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
                            <form method="POST" action="{{ route('empleado.mascotas.store') }}" class="space-y-5">
                                @csrf

                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block text-gray-700 font-medium mb-1">Nombre</label>
                                    <input type="text" name="nombre" value="{{ old('nombre') }}" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" />
                                </div>

                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block text-gray-700 font-medium mb-1">Especie</label>
                                    <select id="especie" name="especie" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition">
                                        <option value="">-- Seleccioná una especie --</option>
                                        <option value="Perro">Perro</option>
                                        <option value="Gato">Gato</option>
                                        <option value="Ave">Ave</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>

                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block text-gray-700 font-medium mb-1">Raza</label>
                                    <select id="raza" name="raza" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition">
                                        <option value="">-- Seleccioná una raza --</option>
                                    </select>
                                </div>

                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block text-gray-700 font-medium mb-1">Fecha de nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                                        required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" />
                                </div>

                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block text-gray-700 font-medium mb-1">Dueño (usuario)</label>
                                    <select name="user_id" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition">
                                        <option value="">-- Seleccioná un usuario --</option>
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->name }} (ID: {{ $cliente->id }})</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="flex justify-center gap-3 pt-4">
                                    <button type="submit"
                                        class="px-4 py-2 rounded text-sm text-white font-semibold transition"
                                        style="background-color: #06b6d4;"
                                        onmouseover="this.style.backgroundColor='#0891b2'"
                                        onmouseout="this.style.backgroundColor='#06b6d4'">
                                        Crear
                                    </button>

                                    <button type="button" onclick="window.location='{{ route('empleado.mascota') }}'"
                                        class="px-4 py-2 rounded text-sm text-white font-semibold transition"
                                        style="background-color: rgb(212, 57, 6);"
                                        onmouseover="this.style.backgroundColor='rgb(170, 30, 5)'"
                                        onmouseout="this.style.backgroundColor='rgb(212, 57, 6)'">
                                        Cancelar
                                    </button>
                                </div>
                            </form>

                            <!-- Script para select encadenado -->
                            <script>
                                const especieSelect = document.getElementById('especie');
                                const razaSelect = document.getElementById('raza');

                                const razasPorEspecie = {
                                    "Perro": ["Labrador", "Caniche", "Bulldog", "Dogo", "Otro"],
                                    "Gato": ["Siamés", "Persa", "Maine Coon", "Sphynx", "Otro"],
                                    "Ave": ["Canario", "Perico", "Loro", "Cacatúa", "Otro"],
                                    "Otro": ["Otra raza"]
                                };

                                especieSelect.addEventListener('change', function () {
                                    const especie = this.value;
                                    const razas = razasPorEspecie[especie] || [];

                                    razaSelect.innerHTML = '<option value="">-- Seleccioná una raza --</option>';
                                    razas.forEach(function (raza) {
                                        const option = document.createElement('option');
                                        option.value = raza;
                                        option.textContent = raza;
                                        razaSelect.appendChild(option);
                                    });
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
