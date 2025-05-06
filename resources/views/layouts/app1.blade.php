<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.head')

    <title>@yield('title', 'Carrusel de Videos')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


</head>
<body class="bg-gray-100">
    @include('partials.header') <!-- Header visual -->
    @yield('content') <!-- Contenido dinámico -->
    @include('partials.footer') <!-- Footer -->

    
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Desplegador de menu -->
    <script type="text/javascript"
        src="https://www.mexicodesconocido.com.mx/wp-content/themes/md2020/js/jquery.min.js?ver=2.1.0" id="jquerymin-js">
    </script>
    <!-- nav-->
    <!-- Google Analytics clásico -->
<script async src="https://www.google-analytics.com/analytics.js"></script>

    <script type="text/javascript"
        src="https://www.mexicodesconocido.com.mx/wp-content/themes/md2020/js/assets.js?ver=3.3.3.2.32" id="assets-js">
    </script> 

    @stack('scripts')

</body>
</html>
