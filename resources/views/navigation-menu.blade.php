<div x-data="{ open: false }">
    <style>
        i{
            margin-right: 4px;"
        }
    </style>
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    @if(isset($isLogoActive) && $isLogoActive)
                        <a href="{{ route('dashboard') }}" class="flex-shrink-0 flex items-center">
                            <img src="{{ asset('logos/logo.png') }}" alt="Logo" class="block h-9 w-auto">
                        </a>
                    @endif

                    <!-- Mobile menu button -->
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out sm:hidden">
                        <!-- Icono de hamburguesa -->
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Desktop menu -->
                <div class="hidden sm:flex sm:items-center space-x-4">
                    @auth
                    <x-nav-link href="/">
                        <i class="fas fa-home"></i> <!-- Icono de casa -->

                        {{ __('Inicio') }}
                    </x-nav-link>
                        <!-- Mostrar opciones para usuarios autenticados -->  
                        <x-nav-link href="{{ route('dashboard') }}">
                            <i class="fas fa-user"></i>

                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('apariencia') }}">
                            <i class="fas fa-paint-brush"></i> <!-- Icono de paleta -->
                            {{ __('Apariencia') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('update-legal-text') }}">
                            <i class="fas fa-file-alt"></i> <!-- Icono de documento -->
                            {{ __('Texto legal') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('update-checkboxs') }}">
                            <i class="fas fa-check-square"></i> <!-- Icono de casilla de verificación -->
                            {{ __('Checkboxes') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('buscador') }}">
                            <i class="fas fa-search"></i> <!-- Icono de búsqueda -->
                            {{ __('Buscador') }}
                        </x-nav-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt"></i> <!-- Icono de salida -->
                                {{ __('Logout') }}
                            </x-nav-link>
                        </form>
                    @else
                        <!-- Mostrar opciones para usuarios no autenticados (guests) -->
                        <x-nav-link href="">
                            <!-- Icono de casa -->
                            <i class="fas fa-home"></i>
                            {{ __('Inicio') }}
                        </x-nav-link>
                        
                        <x-nav-link href="{{ route('login') }}">
                            <!-- Icono de usuario -->
                            <i class="fas fa-sign-in-alt"></i>
                            {{ __('Login') }}
                        </x-nav-link>
                        
                        <x-nav-link href="{{ route('register') }}">
                            <!-- Icono de registro -->
                            <i class="fas fa-user-plus"></i>
                            {{ __('Register') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div x-show="open" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <!-- Mostrar opciones para dispositivos móviles -->
                
                <x-responsive-nav-link  href="/" :active="request()->routeIs('dashboard')">
                    <i class="fas fa-home"></i> <!-- Icono de casa -->
                    {{ __('Inicio') }}
                </x-responsive-nav-link>
                @guest
                    <x-responsive-nav-link href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt" ></i> <!-- Icono de entrada -->
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('register') }}">
                        <i class="fas fa-user-plus"></i> <!-- Icono de registro -->
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @else
                <x-responsive-nav-link href="{{ route('dashboard') }}">
                    <i class="fas fa-user"></i>  <!-- Icono de casilla de verificación -->
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('update-checkboxs') }}">
                        <i class="fas fa-check-square"></i>  <!-- Icono de casilla de verificación -->
                        {{ __('Checkboxes') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('update-legal-text') }}">
                        <i class="fas fa-file-alt"></i> <!-- Icono de documento -->
                        {{ __('Texto legal') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('apariencia') }}">
                        <i class="fas fa-paint-brush"></i> <!-- Icono de paleta -->
                        {{ __('Apariencia') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('buscador') }}">
                        <i class="fas fa-search"></i> <!-- Icono de búsqueda -->
                        {{ __('Buscador') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt"></i> <!-- Icono de salida -->
                            {{ __('Logout') }}
                        </x-nav-link>
                    </form>
                @endguest
            </div>
        </div>
    </nav>
</div>
