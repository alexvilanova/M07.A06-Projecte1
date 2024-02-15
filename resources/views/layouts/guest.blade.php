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
            z-index: -1;
        }

        .content-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased relative">
    <video autoplay muted loop id="bg-video" class="fixed top-0 left-0 min-w-full min-h-full object-cover">
        <source src="./image/login.mp4" type="video/mp4">
        Tu navegador no soporta el tag de video.
    </video>

    <div class="content-wrapper bg-transparent">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 bg-opacity-40 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>