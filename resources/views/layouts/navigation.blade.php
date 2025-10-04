<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!--ACA LO QUE HACE ES AUTENTICAR EL USUARIO EN BASE A SU ROL Y DEPENDIENDO TU ROL ES A DONDE TE ENVIA SI AL DASHBOARD DE EMPLEADO O DE CLIENTE-->
                    @auth
                        @php
                            $role = Auth::user()->role ?? '';
                        @endphp

                        @if($role === 'empleado')
                            <img src="{{ asset('/storage/imagenes/logo_empleado01.png') }}" alt="agregar-usuario" class="mx-auto h-16 my-6 px-4">

                            <x-nav-link :href="route('empleado.dashboard')" :active="request()->routeIs('empleado.dashboard')">
                                {{ __('Empleado Dashboard') }}
                            </x-nav-link>  
                            <x-nav-link :href="route('empleado.usuario')" :active="request()->routeIs('empleado.usuario')">
                                {{ __('Gestor Clientes') }}
                            </x-nav-link>
                            <x-nav-link :href="route('empleado.mascota')" :active="request()->routeIs('empleado.mascota')">
                                {{ __('Gestor Mascotas') }}
                            </x-nav-link>
                            <x-nav-link :href="route('empleado.diagnostico')" :active="request()->routeIs('empleado.diagnostico')">
                                {{ __('Gestor Diagnóstico') }}
                            </x-nav-link>
                            <x-nav-link :href="route('empleado.factura')" :active="request()->routeIs('empleado.factura')">
                                {{ __('Gestor Facturas') }}
                            </x-nav-link>
                        @elseif($role === 'cliente')
                            <img src="{{ asset('/storage/imagenes/logo_usuario01.png') }}" alt="agregar-usuario" class="mx-auto h-16 my-6 px-4">

                            <x-nav-link :href="route('cliente.dashboard')" :active="request()->routeIs('cliente.dashboard')">
                                {{ __('Cliente Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('cliente.clienteMascotas')" :active="request()->routeIs('cliente.clienteMascotas')">
                                {{ __('Cliente Mascotas') }}
                            </x-nav-link>
                            <x-nav-link :href="route('cliente.clienteDiagnostico')" :active="request()->routeIs('cliente.clienteDiagnostico')">
                                {{ __('Cliente Diagnóstico') }}
                            </x-nav-link>
                            <x-nav-link :href="route('cliente.clienteFacturas')" :active="request()->routeIs('cliente.clienteFacturas')">
                                {{ __('Cliente Facturas') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown aling="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar Sesion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <!--ACA LO QUE HACE ES AUTENTICAR EL USUARIO EN BASE A SU ROL Y DEPENDIENDO TU ROL ES A DONDE TE ENVIA SI AL DASHBOARD DE EMPLEADO O DE CLIENTE-->
            @auth
                @php
                    $role = Auth::user()->role ?? '';
                @endphp

                @if($role === 'empleado')
                    <x-responsive-nav-link :href="route('empleado.dashboard')" :active="request()->routeIs('empleado.dashboard')">
                        {{ __('Empleado Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('empleado.usuario')" :active="request()->routeIs('empleado.usuario')">
                        {{ __('Gestor Clientes') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('empleado.mascota')" :active="request()->routeIs('empleado.mascota')">
                        {{ __('Gestor Mascotas') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('empleado.diagnostico')" :active="request()->routeIs('empleado.diagnostico')">
                        {{ __('Gestor Diagnóstico') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('empleado.factura')" :active="request()->routeIs('empleado.factura')">
                        {{ __('Gestor Facturas') }}
                    </x-responsive-nav-link>
                <!-- cliente responsive -->
                @elseif($role === 'cliente')
                    <x-responsive-nav-link :href="route('cliente.dashboard')" :active="request()->routeIs('cliente.dashboard')">
                        {{ __('Cliente Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('cliente.clienteMascotas')" :active="request()->routeIs('cliente.clienteMascotas')">
                        {{ __('Cliente Mascotas') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('cliente.clienteDiagnostico')" :active="request()->routeIs('cliente.clienteDiagnostico')">
                        {{ __('Cliente Diagnóstico') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('cliente.clienteFacturas')" :active="request()->routeIs('cliente.clienteFacturas')">
                        {{ __('Cliente Facturas') }}
                    </x-responsive-nav-link>
                @endif


            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
