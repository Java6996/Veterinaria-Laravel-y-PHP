@extends('partials.plantilla')

@section('header')
    <div class="flex flex-col items-center justify-center gap-4 py-3">
        <!-- imagen + título -->
        <div class="flex items-center justify-center gap-4">
            <img src="{{ asset('/storage/imagenes/factura.png') }}" alt="Perfil" class="h-14">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('¡Aquí podras encontrar tus facturas registradas!') }}
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
                            <th>Nro de Factura</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($facturas as $factura)
                        <tr>
                            <td>{{ $factura->id }}</td>
                            <td>{{ $factura->fecha_emision}}</td>
                            <td>${{ number_format($factura->monto, 2) }}</td>
                            <!-- ver por que no muestra el estado -->
                            <!-- <td>{{ ucfirst((string) $factura->estado_pago) }}</td> -->
                            <td>
                                @if(strtolower($factura->estado_pago) === 'pagado')
                                    <span style="display:inline-block;padding:4px 12px;border-radius:8px;background:#bbf7d0;color:#166534;font-weight:600;">
                                        {{ ucfirst($factura->estado_pago) }}
                                    </span>
                                @else
                                    <span style="display:inline-block;padding:4px 12px;border-radius:8px;background:#fecaca;color:#991b1b;font-weight:600;">
                                        {{ ucfirst($factura->estado_pago) }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; color:#16a34a; font-style:italic;">
                                No tienes Facturas registradas.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection