@extends('partials.plantilla')

@section('header')
<div class="flex flex-col items-center justify-center gap-4 py-3">
    <!-- imagen y header -->
    <div class="flex items-center justify-center gap-4">
        <img src="{{ asset('/storage/imagenes/editar-diagnostico.png') }}" alt="Editar Diagnóstico" class="h-14">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('¡Aquí podés editar el diagnóstico!') }}
        </h2>
    </div>
    <h3 class="text-sm sm:text-base text-gray-600 font-medium text-center px-4 max-w-xl">
        Podés modificar los campos relacionados con la consulta médica de la mascota.
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
                            <form method="POST" action="{{ route('empleado.diagnosticos.update', $diagnostico->id) }}">
                                @csrf
                                @method('PUT')

                                <!-- Mascota -->
                                <!-- Mascota (solo lectura) -->
                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block mb-1 text-gray-700">Mascota:</label>

                                    <!-- Mostrar el nombre y dueño (sin poder editar) -->
                                    <input
                                        type="text"
                                        readonly
                                        value="{{ $diagnostico->mascota->nombre }} - {{ $diagnostico->mascota->user->name ?? 'Sin dueño' }}"
                                        class="w-full bg-gray-100 border border-sky-300 p-2 rounded text-gray-700 cursor-not-allowed"
                                    >

                                    <!-- Enviar el ID oculto -->
                                    <input type="hidden" name="mascota_id" value="{{ $diagnostico->mascota_id }}">
                                </div>

                                <!--  Síntomas  -->
                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block mb-1 text-gray-700">Síntomas:</label>
                                    <textarea name="sintomas" rows="2"
                                        class="w-full border border-sky-500 focus:border-sky-600 focus:ring-sky-500 p-2 mb-4 rounded">{{ old('sintomas', $diagnostico->sintomas) }}</textarea>
                                </div>

                                <!-- diagnostico -->
                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block mb-1 text-gray-700">Diagnóstico:</label>
                                    <textarea name="diagnostico" rows="2"
                                        class="w-full border border-sky-500 focus:border-sky-600 focus:ring-sky-500 p-2 mb-4 rounded">{{ old('diagnostico', $diagnostico->diagnostico) }}</textarea>
                                </div>

                                <!-- tratamiento -->
                                <div class="flex flex-col gap-4 w-full">
                                    <label class="block mb-1 text-gray-700">Tratamiento:</label>
                                    <textarea name="tratamiento" rows="2"
                                        class="w-full border border-sky-500 focus:border-sky-600 focus:ring-sky-500 p-2 mb-4 rounded">{{ old('tratamiento', $diagnostico->tratamiento) }}</textarea>
                                </div>


                                <!-- botones -->
                                <div class="flex flex-col gap-4 w-full">
                                    <div class="flex justify-center gap-4">
                                        <button type="submit" style="background-color: #06b6d4;"
                                            class="text-white px-4 py-2 rounded hover:opacity-90 transition">
                                            Actualizar
                                        </button>
                                        <button type="button"
                                            onclick="window.location='{{ route('empleado.diagnostico') }}'"
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
</div>
@endsection
