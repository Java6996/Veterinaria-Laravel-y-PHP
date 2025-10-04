<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-center gap-4">
            <img src="{{ asset('/storage/imagenes/perfil.png') }}" alt="Perfil" class="h-14">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Aquí encontrarás las opciones para administrar tu perfil') }}
            </h2>
        </div>
    </x-slot>


    <div class="py-12 relative" style="
    background: url('{{ asset('/storage/imagenes/fondo_opacidad.png') }}') center center / cover no-repeat;
    z-index: 0;">
    
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
