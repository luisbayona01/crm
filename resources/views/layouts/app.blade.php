<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="intREasso">
        <meta name="author" content="CRM">
        <!-- Etiquetas para Twitter-->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:description" content="intREasso">
        <meta name="twitter:title" content="CRM | intREasso">
        <meta name="twitter:site" content="CRM">
        <meta name="twitter:image" content="{{asset('img/banner.png')}}">
        <meta name="twitter:creator" content="CRM">
        <!-- Etiquetas Open Graph-->
        <meta property="og:locale" content="es_ES">
        <meta property="og:type" content="article">
        <meta property="og:title" content="CRM | intREasso">
        <meta property="og:description" content="intREasso">
        <meta property="og:url" content="https://www.eniun.com/12-leyes-experiencia-de-usuario-ux/">
        <meta property="og:site_name" content="CRM">
        <meta property="og:image" content="{{asset('img/banner.png')}}">
        <meta property="og:image:secure_url" content="{{asset('img/banner.png')}}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="600">
    
        <title>CRM | intREasso</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        {{-- Favicon --}}
        <link rel="icon" type="image/x-icon" href="{{asset('img/logo.png')}}" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
