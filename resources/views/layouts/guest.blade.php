<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Gestion de contactos">
        <meta name="author" content="CRM intREasso">
        <!-- Etiquetas para Twitter-->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:description" content="Gestion de contactos">
        <meta name="twitter:title" content="CRM intREasso">
        <meta name="twitter:site" content="CRM intREasso">
        <meta name="twitter:image" content="{{asset('img/banner.png')}}">
        <meta name="twitter:creator" content="CRM intREasso">
        <!-- Etiquetas Open Graph-->
        <meta property="og:locale" content="es_ES">
        <meta property="og:type" content="article">
        <meta property="og:title" content="CRM intREasso">
        <meta property="og:description" content="Gestion de contactos">
        <meta property="og:url" content="intREasso.org">
        <meta property="og:site_name" content="CRM intREasso">
        <meta property="og:image" content="{{asset('img/banner.png')}}">
        <meta property="og:image:secure_url" content="{{asset('img/banner.png')}}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="600">
    
        <title>intREasso</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Custom fonts for this template-->
        <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
        {{-- Favicon --}}
        <link rel="icon" type="image/x-icon" href="{{asset('img/logo.png')}}" />
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
