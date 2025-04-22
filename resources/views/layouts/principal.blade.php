<!DOCTYPE html>
<html lang="es">

<head>
    
    @include('partials.head')
    <!-- Metadatos y enlaces CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">

    <!-- Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Tailwind CSS CDN (para pruebas rápidas) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- estilos css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <!-- Alpine.js PARA EDITAR -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @stack('styles')
</head>

<body>
    @include('partials.header') <!-- Header visual -->
    @yield('content') <!-- Contenido dinámico -->
    @include('partials.footer') <!-- Footer -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Desplegador de menu -->
    <script type="text/javascript"
        src="https://www.mexicodesconocido.com.mx/wp-content/themes/md2020/js/jquery.min.js?ver=2.1.0" id="jquerymin-js">
    </script>
    <script type="text/javascript"
        src="https://www.mexicodesconocido.com.mx/wp-content/themes/md2020/js/assets.js?ver=3.3.3.2.32" id="assets-js">
    </script>

    <!-- VUE
    <script type="text/javascript"
        src="https://www.mexicodesconocido.com.mx/wp-content/themes/md2020/js/descubrev2.js?ver=1.34"
        id="my_vuecode_descubrev2-js"></script>
    -->
    <script type="text/javascript"
        src="https://www.mexicodesconocido.com.mx/wp-content/themes/md2020/js/owl.carousel.min.js?ver=1.0.0"
        id="carousel-js"></script>
    <script type="text/javascript" src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js?ver=1.0.0"
        id="remote_sdk-js" defer="defer" data-wp-strategy="defer"></script>

    
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>

    <!-- DataTables-->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <!-- OneSignal SDK -->
    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>

    <!-- Lazy Loading Scripts -->
    <script type="text/javascript" id="flying-scripts">
        const loadScriptsTimer = setTimeout(loadScripts, 10 * 1000);
        const userInteractionEvents = ['click', 'mousemove', 'keydown', 'touchstart', 'touchmove', 'wheel'];
        userInteractionEvents.forEach(function(event) {
            window.addEventListener(event, triggerScriptLoader, {
                passive: true
            });
        });

        function triggerScriptLoader() {
            loadScripts();
            clearTimeout(loadScriptsTimer);
            userInteractionEvents.forEach(function(event) {
                window.removeEventListener(event, triggerScriptLoader, {
                    passive: true
                });
            });
        }

        function loadScripts() {
            document.querySelectorAll("script[data-type='lazy']").forEach(function(elem) {
                elem.setAttribute("src", elem.getAttribute("data-src"));
            });
        }
    </script>

    <!-- Inicialización de DataTables CORREGIDO-->
    <script>
        $(document).ready(function () {
            $('#funcionesTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'pdf', 'csv', 'print'],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        });
    </script>

    <!-- Agente Artificial -->
    <script>
        $(document).ready(function() {
            $('td[id^="agent-response-"]').each(function() {
                const rowId = $(this).attr('id').split('-')[2];
                const question = $(this).closest('tr').find('td:nth-child(2)').text();

                $.ajax({
                    url: 'https://aarondan.app.n8n.cloud/webhook/09e02f3c-4954-41cd-8dd4-73603214dd84/chat',
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    data: JSON.stringify({
                        question
                    }),
                    success: function(response) {
                        const cleanedResponse = response.data.replace(
                            /<function[^>]*>.*?<\/function>/g, '');
                        $(`#agent-response-${rowId}`).text(cleanedResponse);
                    },
                    error: function() {
                        $(`#agent-response-${rowId}`).text('Error al cargar respuesta');
                    }
                });
            });
        });
    </script>

    <!-- n8n Chat -->
    <script type="module">
        import {
            createChat
        } from 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/chat.bundle.es.js';

        createChat({
            webhookUrl: 'https://aarondan.app.n8n.cloud/webhook/09e02f3c-4954-41cd-8dd4-73603214dd84/chat',
            target: '#n8n-chat',
            mode: 'window',
            defaultLanguage: 'es',
            initialMessages: [
                'Hola! 👋',
                'Soy el asistente virtual. ¿Cómo puedo ayudarte hoy?'
            ],
            i18n: {
                es: {
                    title: '¡Hola! 👋',
                    subtitle: "Inicia una conversación. Estamos aquí para ayudarte 24/7.",
                    footer: '',
                    getStarted: 'Nueva Conversación',
                    inputPlaceholder: 'Escribe tu pregunta...',
                },
            },
        });
    </script>

<!------------------------------------------------->
    @stack('scripts')
</body>

</html>
