<!DOCTYPE html>
<html lang="es">

<head>
    @include('partials.head') <!-- Metadatos y enlaces CSS -->
    <li><a class="nav-link" href="{{ route('culturas.index') }}">Culturas</a></li>

    <!-- Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Tailwind CSS CDN (para pruebas rápidas) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Alpine.js PARA EDITAR -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @stack('styles')

</head>

</head>

<body>
    @include('partials.header') <!-- Header visual -->

    @yield('content') <!-- Contenido dinámico -->

    @include('partials.footer') <!-- Footer -->
</main>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&amp;display=swap" rel="stylesheet">


    <!-- Desplegador de menu -->
    <script type="text/javascript"
        src="https://www.mexicodesconocido.com.mx/wp-content/themes/md2020/js/jquery.min.js?ver=2.1.0" id="jquerymin-js">
    </script>
    <script type="text/javascript"
        src="https://www.mexicodesconocido.com.mx/wp-content/themes/md2020/js/assets.js?ver=3.3.3.2.32" id="assets-js">
    </script>

    <script type="text/javascript"
        src="https://www.mexicodesconocido.com.mx/wp-content/themes/md2020/js/descubrev2.js?ver=1.34"
        id="my_vuecode_descubrev2-js"></script>
    <script type="text/javascript"
        src="https://www.mexicodesconocido.com.mx/wp-content/themes/md2020/js/owl.carousel.min.js?ver=1.0.0"
        id="carousel-js"></script>
    <script type="text/javascript" src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js?ver=1.0.0"
        id="remote_sdk-js" defer="defer" data-wp-strategy="defer"></script>

    <script type="text/javascript" id="flying-scripts">
        const loadScriptsTimer = setTimeout(loadScripts, 10 * 1000);
        const userInteractionEvents = ['click', 'mousemove', 'keydown', 'touchstart', 'touchmove', 'wheel'];
        userInteractionEvents.forEach(function(event) {
            window.addEventListener(event, triggerScriptLoader, {
                passive: !0
            })
        });

        function triggerScriptLoader() {
            loadScripts();
            clearTimeout(loadScriptsTimer);
            userInteractionEvents.forEach(function(event) {
                window.removeEventListener(event, triggerScriptLoader, {
                    passive: !0
                })
            })
        }

        function loadScripts() {
            document.querySelectorAll("script[data-type='lazy']").forEach(function(elem) {
                elem.setAttribute("src", elem.getAttribute("data-src"))
            })
        }
    </script>
    <script type="text/javascript" src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js?ver=1.0.0"
        id="remote_sdk-js" defer="defer" data-wp-strategy="defer"></script>
    <script type="text/javascript" id="flying-scripts">
        const loadScriptsTimer = setTimeout(loadScripts, 10 * 1000);
        const userInteractionEvents = ['click', 'mousemove', 'keydown', 'touchstart', 'touchmove', 'wheel'];
        userInteractionEvents.forEach(function(event) {
            window.addEventListener(event, triggerScriptLoader, {
                passive: !0
            })
        });

        function triggerScriptLoader() {
            loadScripts();
            clearTimeout(loadScriptsTimer);
            userInteractionEvents.forEach(function(event) {
                window.removeEventListener(event, triggerScriptLoader, {
                    passive: !0
                })
            })
        }

        function loadScripts() {
            document.querySelectorAll("script[data-type='lazy']").forEach(function(elem) {
                elem.setAttribute("src", elem.getAttribute("data-src"))
            })
        }
    </script>
<!------------------------------------------------->
@stack('scripts')

</body>

</html>
