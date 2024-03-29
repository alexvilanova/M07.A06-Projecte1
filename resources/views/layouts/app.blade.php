<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-solid-straight/css/uicons-solid-straight.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
   <!-- Styles and scripts -->
   @env(['local','development'])
       @vite(['resources/css/app.css', 'resources/js/app.js'])  
   @endenv
   @env(['production'])
       @php
           $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
       @endphp
       <link rel="stylesheet" href="{{ asset('build/'.$manifest['resources/css/app.css']['file']) }}">
       <script type="module" src="{{ asset('build/'.$manifest['resources/js/app.js']['file']) }}"></script>
   @endenv

    <!-- SEO -->
    {!! seo() !!}

    <style>
        body {
            font-family: 'figtree', sans-serif;
            margin: 0;
            padding: 0;
            
        }

        #bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1; /* Asegura que el video esté detrás del contenido */
        }

        .content-wrapper {
            position: relative;
            z-index: 1; /* Asegura que el contenido esté sobre el video */
        }

        main {
            position: relative;
        }
    </style>
</head>
<body class="font-sans antialiased bg-no-repeat bg-cover bg-center bg-fixed">
    <div class="min-h-screen flex flex-col">
        @include('layouts.navigation')

        @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <main class="flex-1 content-wrapper">
            <div class="w-full">
                @include('partials.flash')
            </div>
            {{ $slot }}
        </main>
        <video autoplay muted loop id="bg-video" class="hidden md:block absolute inset-0 object-cover w-full h-full">
            <source src="{{ asset('image/app.mp4') }}" type="video/mp4">
            Tu navegador no soporta el tag de video.
        </video>
    </div>
</body>
</html>