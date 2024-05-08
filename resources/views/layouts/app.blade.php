<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>GAME</title>

        
        @vite('resources/css/app.css', 'resources/js/app.js')

        @livewireStyles
<!-- sección de scripts-->

<script src="https://kit.fontawesome.com/cb9ca1e7ae.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="nuevo_hash_sha512" crossorigin="anonymous" />



        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    </head>
    <body class="font-sans antialiased dark:bg-white dark:text-black">
        
            @include('navigation-menu')

                <div id="container">
                    @yield('content')
                </div>
                    
                    

                </div>
            </div>
        </div>

        @livewireScripts




    <!-- Include utilities script for intl-tel-input -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"></script>
    </body>
</html>
