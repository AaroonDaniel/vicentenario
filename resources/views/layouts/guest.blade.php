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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        @stack('styles')

    </head>
    <body >
        <div >
                {{ $slot }}
        </div>
    </body>
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
</html>
