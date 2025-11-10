<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    
    <body class="font-sans antialiased bg-gray-100">
        
        <div class="flex min-h-screen">
            

            <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                
                @if (isset($header))
                    <header class="bg-white shadow border-b border-gray-200">
                        <div class="flex items-center justify-between max-w-full mx-auto py-4 px-8">
                             <h1 class="text-xl font-semibold text-gray-800">{{ $header }}</h1>
                            <div class="text-sm text-gray-500">
                                Olá, {{ Auth::user()->name ?? 'Usuário' }}
                            </div>
                        </div>
                    </header>
                @endif

                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        @livewireScripts
        @stack('scripts')
    </body>
</html>