@extends('partials.plantilla')

@section('header')
<div class="flex flex-col items-center justify-center gap-4 py-3">
    <div class="flex items-center justify-center gap-4">
        <img src="{{ asset('/storage/imagenes/agregar-factura.png') }}" alt="Agregar Factura" class="h-14">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('¡Aquí podés agregar una nueva factura!') }}
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
                            <form method="POST" action="{{ route('empleado.facturas.store') }}" class="space-y-5">
                                @csrf

                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block text-gray-700 font-medium mb-1">Monto</label>
                                    <input type="number" name="monto" value="{{ old('monto') }}" step="0.01" min="0" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" 
                                        placeholder="0.00" />
                                </div>

                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block text-gray-700 font-medium mb-1">Fecha de Emisión</label>
                                    <input type="date" name="fecha_emision" value="{{ old('fecha_emision', date('Y-m-d')) }}" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" />
                                </div>

                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block text-gray-700 font-medium mb-1">Estado de Pago</label>
                                    <select name="estado_pago" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition">
                                        <option value="">-- Seleccioná un estado --</option>
                                        <option value="Pendiente" {{ old('estado_pago') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="Pagado" {{ old('estado_pago') == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                                    </select>
                                </div>

                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block text-gray-700 font-medium mb-1">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition" 
                                        placeholder="ejemplo@email.com" />
                                </div>

                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block text-gray-700 font-medium mb-1">Cliente</label>
                                    <select name="user_id" required
                                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-cyan-500 transition">
                                        <option value="">-- Seleccioná un cliente --</option>
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}" {{ old('user_id') == $cliente->id ? 'selected' : '' }}>
                                                {{ $cliente->name }} - {{ $cliente->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex justify-center gap-3 pt-4">
                                    <button type="submit"
                                        class="px-4 py-2 rounded text-sm text-white font-semibold transition"
                                        style="background-color: #06b6d4;"
                                        onmouseover="this.style.backgroundColor='#0891b2'"
                                        onmouseout="this.style.backgroundColor='#06b6d4'">
                                        Crear Factura
                                    </button>

                                    <button type="button" onclick="window.location='{{ route('empleado.factura') }}'"
                                        class="px-4 py-2 rounded text-sm text-white font-semibold transition"
                                        style="background-color: rgb(212, 57, 6);"
                                        onmouseover="this.style.backgroundColor='rgb(170, 30, 5)'"
                                        onmouseout="this.style.backgroundColor='rgb(212, 57, 6)'">
                                        Cancelar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 