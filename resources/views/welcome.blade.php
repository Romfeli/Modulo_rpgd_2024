<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GAME</title>

        
        @vite('resources/css/app.css', 'resources/js/app.js')

        @livewireStyles

        <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    </head>
    <body class="font-sans antialiased dark:bg-white dark:text-black">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            logo
                        </div>
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-center">
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-white"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </header>



                    <main class="mt-6">
                        @if(session()->has('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">¡Éxito!</strong>
                                <span class="block sm:inline">{{ session()->get('success') }}</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <title>Cerrar</title>
                                        <path d="M14.348 14.849a1 1 0 0 1-1.497 1.32l-3.85-4.057-3.849 4.057a1 1 0 1 1-1.498-1.32l3.849-4.057-3.849-4.057a1 1 0 1 1 1.498-1.32l3.849 4.057 3.85-4.057a1 1 0 1 1 1.497 1.32l-3.85 4.057 3.85 4.057z"/>
                                    </svg>
                                </span>
                            </div>
                        @endif
                        <div>
                            <livewire:lista-participantes />
                        </div>
                        <div>
                            <livewire:agregar-formulario />
                        </div>
                    </main>
                    

                   
                </div>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
