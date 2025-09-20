<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Primary Meta Tags --}}
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Lee Marketing Services - Digital solutions that drive results.')">

    {{-- Open Graph / Facebook --}}
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('meta_title', config('app.name'))" />
    <meta property="og:description" content="@yield('meta_description', 'Lee Marketing Services - Digital solutions that drive results.')">
    <meta property="og:image" content="@yield('meta_image', asset('assets/top-logo.png'))" />

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('meta_title', config('app.name'))" />
    <meta name="twitter:description" content="@yield('meta_description', 'Lee Marketing Services - Digital solutions that drive results.')">
    <meta name="twitter:image" content="@yield('meta_image', asset('assets/top-logo.png'))">

    {{-- Author (Optional) --}}
    <meta property="article:author" content="@yield('meta_author', 'Admin')" />

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('storage/' . ($favicon ?? 'default-favicon.png')) }}" type="image/x-icon">

    {{-- Fonts & External CSS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-space-dynamic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    {{-- Icons --}}
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>

    {{-- Vite Styles (if using Laravel Mix/Vite) --}}
    @vite('resources/css/app.css')
</head>

<body class="antialiased">

    {{-- Preloader --}}
    <x-preloader />

    {{-- Navigation Bar --}}
    <livewire:components.nav-bar />

    {{-- Main Page Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <x-footer />

    {{-- Livewire --}}
    <livewire:styles />
    <livewire:scripts />

    {{-- JS Scripts --}}
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://assets.calendly.com/assets/external/widget.js"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/js/animation.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.js') }}"></script>
    <script src="{{ asset('assets/js/templatemo-custom.js') }}"></script>
    <script src="{{ asset('assets/js/tawkto/tawkto.js') }}"></script>
</body>

</html>
