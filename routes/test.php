<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale())}}">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{csrf_token()}}">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Space Dynamic - SEO HTML5 Template</title>

    {{-- Live Wire Styles --}}

    @livewireScripts
    @livewireStyles



    <!-- Bootstrap core CSS -->
    {{-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
    @vite('resources/css/app.css')

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{'assets/css/fontawesome.css'}}">
    <link rel="stylesheet" href="{{'assets/css/templatemo-space-dynamic.css'}}">
    <link rel="stylesheet" href="{{'assets/css/animated.css'}}">
    <link rel="stylesheet" href="{{'assets/css/owl.css'}}">

  </head>

<body>

  <!-- ***** Preloader Start ***** -->
    <x-preloader />
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
    <x-navbar />
  <!-- ***** Header Area End ***** -->

  @livewireScripts
  @livewireStyles
<main>
    {{-- Slots --}}
    {{ $slot }}

</main>
 <x-footer />
  <!-- Scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/animation.js"></script>
  <script src="assets/js/imagesloaded.js"></script>
  <script src="assets/js/templatemo-custom.js"></script>

</body>
</html>
