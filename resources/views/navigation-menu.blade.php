<div x-data="{ open: false }">
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <a href="{{ route('dashboard') }}" class="flex-shrink-0 flex items-center">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>

                    <!-- Mobile menu button -->
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out sm:hidden">
                        <!-- Icono de hamburguesa -->
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile menu -->
                <div class="hidden sm:flex sm:items-center space-x-4">
                    @guest
                        <x-nav-link href="{{ route('login') }}">{{ __('Login') }}</x-nav-link>
                        <x-nav-link href="{{ route('register') }}">{{ __('Register') }}</x-nav-link>
                    @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Logout') }}</x-nav-link>
                        </form>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div x-show="open" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link>
                @guest
                    <x-responsive-nav-link href="{{ route('login') }}">{{ __('Login') }}</x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('register') }}">{{ __('Register') }}</x-responsive-nav-link>
                @else

                    <x-responsive-nav-link href="{{ route('buscador') }}">{{ __('buscador') }}</x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Logout') }}</x-nav-link>
                    </form>
                @endguest
            </div>
        </div>
    </nav>
</div>
