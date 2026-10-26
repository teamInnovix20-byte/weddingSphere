<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'WeddingSphere')</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&display=swap" rel="stylesheet">

    {{-- Tailwind CSS + JS (run `npm run dev` or `npm run build`) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="flex min-h-screen flex-col">
    @include('partials.header')

    {{-- soft gold / pink glow behind every page --}}
    <main class="relative flex-1 overflow-hidden
                 before:pointer-events-none before:absolute before:inset-0
                 before:bg-[radial-gradient(560px_280px_at_50%_0%,rgba(255,226,170,.5),transparent_70%),radial-gradient(460px_460px_at_100%_55%,rgba(255,205,220,.35),transparent_70%)]
                 [&>*]:relative">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
