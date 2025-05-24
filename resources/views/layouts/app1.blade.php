<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.head')

    <title>@yield('title', 'Carrusel de Videos')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        html, body {
            height: 100%;
        }
    </style>

    <!-- DataTables & jQuery (CDN) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- estilos css -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">        
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        
    <!-- Font tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- login-->
        <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>

<body>
    @include('partials.header') <!-- Header visual -->
    @yield('content') <!-- Contenido dinámico -->
    @include('partials.footer')
    
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
    <!-- DataTables-->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
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

    @stack('scripts')



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function togglePassword(inputId, iconId) {
            let passwordInput = document.getElementById(inputId);
            let eyeIcon = document.getElementById(iconId);
    
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`; // Ojo abierto
            } else {
                passwordInput.type = "password";
                eyeIcon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><line x1="4.5" y1="4.5" x2="19.5" y2="19.5"/>`; // Ojo tachado
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#country").change(function() {
                let country_id = this.value;
                if (country_id) {
                    $.get('/get-states', { country: country_id })
                        .done(function(data) {
                            $("#city").html(data.options); // Actualizar el select con las opciones
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            console.error("Error al cargar las ciudades:", textStatus, errorThrown);
                            $("#city").html('<option value="">Error al cargar las ciudades</option>');
                        });
                } else {
                    $("#city").html('<option value="">Selecciona la ciudad</option>'); // Resetear el select
                }
            });
        });
    </script>
    </body>
</html>
