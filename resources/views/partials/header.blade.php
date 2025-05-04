<div id="hs-web-interactives-top-push-anchor" class="go3670563033"></div>

<nav class="nav_close" >

    <section class="inner">
        <img class="logo ready" src="{{ asset('images/Bolivialetra.png') }}" alt="Bicentenario Bolivia"
            title="Bicentenario Bolivia">

        <a href="#close" class="close"><span></span></a>

        <section class="nav_content">
            <ul>
                
                <li id="menu-item-66044"
                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-66044">
                    <a href="{{ '' }}">Inicio</a>
                    
                </li>

                <li id="menu-item-66044"
                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-66044">
                    <a href="{{ 'historias' }}">Historia</a>
                    
                </li>

                

                <li id="menu-item-66051"
                    class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-66051">
                    <a href="{{ 'culturas' }}">Cultura</a>
                    
                </li>
                <li id="menu-item-66059"
                    class="menu-item menu-item-type-post_type menu-item-object-page menu-item-66059">
                    <a href="{{ 'eventos' }}">Eventos</a>
                    <ul class="sub-menu">
                        <li id="menu-item-66045"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-66045">
                            <a
                                href="{{ 'agendaEventos' }}">Agenda
                            </a>
                        </li>

                        <li id="menu-item-66046"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-66046"><a
                                href="{{ 'videos' }}">Multimedia</a></li>
                        <li id="menu-item-66047"
                            class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-66047"><a
                                href="https://www.mexicodesconocido.com.mx/descubre-destinos/ciudades-de-mexico">Expositores
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <section class="links">
                <section class="group">
                    <div class="separator">Guías digitales</div>
                    <a href="https://www.mexicodesconocido.com.mx/viajes-por-carretera">Viajes por carretera</a>
                    <a href="https://pueblosmagicos.mexicodesconocido.com.mx/" target="_blank" rel="noopener">Pueblos
                        Mágicos</a>
                    <a href="https://disfrutatuciudad.mx/" target="_blank" rel="noopener">Ciudad de México</a>
                    <a href="https://hazturismoencoahuila.mx/" target="_blank" rel="noopener">Coahuila</a>
                    <a href="https://paraisosindigenas.com/" target="_blank" rel="noopener">Paraísos
                        Indígenas</a>
                    <a href="https://experienciaedomexmagazine.com/edicion-1/" target="_blank"
                        rel="noopener">Experiencia Edomex</a>
                </section>
                <section class="group">
                    <div class="separator">Información</div>
                    <a href="https://revistadigital.mx/mexicodesconocido-mayo2024/" target="_blank"
                        rel="noopener">Revista Digital</a>
                    <a href="https://g21.com.mx/mexico-desconocido/" target="_blank" rel="noopener">Anúnciate con
                        nosotros</a>
                    <a href="https://g21.com.mx/mexico-desconocido/" target="_blank" rel="noopener">Media Kit</a>
                    <a href="https://www.mexicodesconocido.com.mx/contacto">Contacto</a>
                </section>
                <section class="group">
                    <div class="separator">Síguenos</div>
                    <a href="https://www.facebook.com/mexicodesconocido" target="_blank" rel="noopener noreferrer"
                        class="icon"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a>
                    <a href="https://twitter.com/mexdesconocido" target="_blank" rel="noopener noreferrer"
                        class="icon"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a>
                    <a href="https://www.instagram.com/mexicodesconocido/" target="_blank" rel="noopener noreferrer"
                        class="icon"><i class="fab fa-instagram" aria-hidden="true"></i> Instagram</a>
                    <a href="https://www.youtube.com/user/MEXICODESCONOCIDOTV" target="_blank"
                        rel="noopener noreferrer" class="icon"><i class="fab fa-youtube" aria-hidden="true"></i>
                        YouTube</a>
                    <a href="https://www.pinterest.com.mx/mexdesconocido/" target="_blank" rel="noopener noreferrer"
                        class="icon"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a>
                </section>
            </section>
        </section>
    </section>
</nav>

<section class="search_module nav_close">
    <section class="inner">
        <strong class="title">Buscador</strong>

        <form class="search" role="search" method="get" id="searchform"
            action="https://www.mexicodesconocido.com.mx" data-hs-cf-bound="true">
            <label for="s">Buscar</label>
            <input type="text" value="" name="s" id="s"
                placeholder="Encuentra destinos, experiencias y artículos para inspirarte">
            <button type="submit" id="searchsubmit" value="Search"><span></span></button>
        </form>
    </section>
</section>

<main>
    <header>
        <section class="inner">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="logo"><img alt="Bicentenario Bolivia" title="Bicentenario Bolivia" src="/images/logoOficial.png"
                    class="ready"></a>
            <!-- Botones del Header -->
            <section class="header_btns">
                <!--
                <a href="{{ 'login' }}" target="_blank" rel="noopener" class="btn secondary susc">
                    <i class="fas fa-user"></i>
                    <span>Iniciar Sesión</span>
                </a>-->
                <!-- Botón de Login o Nombre de Usuario -->
                @if (Auth::check())
                    <!-- Si el usuario está autenticado -->
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> <span>{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                        class="fas fa-user-circle"></i> Perfil</a></li>
                            <li><a class="dropdown-item" href="{{ route('agenda.index') }}"><i
                                        class="fa-solid fa-calendar-days"></i> Mi agenda</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                                    @csrf
                                    <button type="submit" class="dropdown-item-logout">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Si el usuario no está autenticado -->
                    <a href="{{ route('login') }}" target="_blank" rel="noopener" class="btn secondary susc">
                        <i class="fas fa-user"></i> <span>Login</span>
                    </a>
                @endif
                <!-- Botón de Búsqueda -->
                <a href="#open_search" class="open_search"><span></span></a>
                <!-- Botón de Menú -->
                <a href="#open_nav" class="open_nav"><span></span></a>
            </section>
        </section>
    </header>

    <div class="raya pt-4">
        <a href="https://bit.ly/4kNLXLD" target="blank" rel="noopener" class="rayabtn right">
            <img src="/images/raya_right.gif"
                class="banner_skin_impression banner_skin_click_right" data-id="lomejormexico2025_22marz_2025"
                width="100" height="500" alt="banner promo izq" data-gtm-vis-recent-on-screen32626292_26="337"
                data-gtm-vis-first-on-screen32626292_26="337" data-gtm-vis-total-visible-time32626292_26="100"
                data-gtm-vis-has-fired32626292_26="1">
        </a>
        <a href="https://bit.ly/4kNLXLD" target="blank" rel="noopener" class="rayabtn left">
            <img src="/images/raya_left1.gif"
                class="banner_skin_click_left" data-id="lomejormexico2025_22marz_2025" width="100" height="500"
                alt="banner promo izq">
        </a>
    </div>
