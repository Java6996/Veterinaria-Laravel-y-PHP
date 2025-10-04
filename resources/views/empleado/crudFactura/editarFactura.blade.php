@extends('partials.plantilla')

@section('header')
<div class="flex flex-col items-center justify-center gap-4 py-3">
    <!-- Fila: imagen + título -->
    <div class="flex items-center justify-center gap-4">
        <img src="{{ asset('/storage/imagenes/editar-factura.png') }}" alt="Editar Factura" class="h-14">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('¡Aquí podés editar la factura seleccionada!') }}
        </h2>
    </div>
    <h3 class="text-sm sm:text-base text-gray-600 font-medium text-center px-4 max-w-xl">
        Podés cambiar el monto, fecha de emisión, estado de pago o email.
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
                            <form method="POST" action="{{ route('empleado.facturas.update', $factura->id) }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block mb-1 text-gray-700 sm:text-right">Monto:</label>
                                    <input type="number" name="monto" value="{{ old('monto', $factura->monto) }}" step="0.01" min="0" required
                                        class="w-full border border-sky-500 focus:border-sky-600 focus:ring-sky-500 p-2 mb-4 rounded">
                                </div>
                                
                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block mb-1 text-gray-700">Fecha de Emisión:</label>
                                    <input type="date" name="fecha_emision" value="{{ old('fecha_emision', $factura->fecha_emision) }}" required
                                        class="w-full border border-sky-500 focus:border-sky-600 focus:ring-sky-500 p-2 mb-4 rounded">
                                </div>
                                
                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block mb-1 text-gray-700">Estado de Pago:</label>
                                    <select name="estado_pago" required
                                        class="w-full border border-sky-500 focus:border-sky-600 focus:ring-sky-500 p-2 mb-4 rounded">
                                        <option value="Pendiente" {{ $factura->estado_pago == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="Pagado" {{ $factura->estado_pago == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                                    </select>
                                </div>
                                
                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block mb-1 text-gray-700">Email:</label>
                                    <input type="email" name="email" value="{{ old('email', $factura->email) }}" required
                                        class="w-full border border-sky-500 focus:border-sky-600 focus:ring-sky-500 p-2 mb-4 rounded">
                                </div>
                                
                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block mb-1 text-gray-700">Cliente:</label>
                                    <select name="user_id" required
                                        class="w-full border border-sky-500 focus:border-sky-600 focus:ring-sky-500 p-2 mb-6 rounded">
                                        @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}"
                                            {{ $factura->user_id == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->name }} - {{ $cliente->email }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="flex flex-col gap-4 w-full">
                                    <div class="flex justify-center gap-4">
                                        <button type="submit" style="background-color: #06b6d4;"
                                            class="text-white px-4 py-2 rounded hover:opacity-90 transition">
                                            Actualizar
                                        </button>
                                        <button type="button"
                                            onclick="window.location='{{ route('empleado.factura') }}'"
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
    </div>
@endsection 