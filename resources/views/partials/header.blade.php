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
                    <a href="{{ '/' }}">Inicio</a>
                    
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
                                href="{{ 'videos' }}">Multimedia-Videos</a>
                        </li>
                        <li id="menu-item-66046"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-66046"><a
                                href="{{ 'galeria' }}">Galeria-fotos</a>
                        </li>
                        <li id="menu-item-66047"
                            class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-66047"><a
                                href="{{ 'expositores' }}">Expositores
                            </a>
                        </li>
                        <li id="menu-item-66047"
                            class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-66047"><a
                                href="{{ 'eventos' }}">Patrocinadores
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <section class="links">
                <section class="group">
                    <div class="separator">Información</div>
                    <a href="{{ route('quienes.somos') }}" target="_blank"
                        rel="noopener">Quienes somos</a>
                    <a href="{{ route('ultimo') }}" target="_blank"
                        rel="noopener">Novedades</a>
                </section>
                <section class="">
                    <div class="separator">Síguenos</div>
                    <a href="#" target="_blank" rel="noopener noreferrer"
                        class="icon flex items-center gap-2 text-gray-700 hover:text-blue-600 transition-colors duration-300"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a>
                    <a href="#" target="_blank" rel="noopener noreferrer"
                        class="icon flex items-center gap-2 text-gray-700 hover:text-teal-600 transition-colors duration-300"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a>
                    <a href="#" target="_blank" rel="noopener noreferrer"
                        class="icon flex items-center gap-2 text-gray-700 hover:text-purple-600 transition-colors duration-300"><i class="fab fa-instagram" aria-hidden="true"></i> Instagram</a>
                    <a href="#" target="_blank"
                        rel="noopener noreferrer" class="icon flex items-center gap-2 text-gray-700 hover:text-red-600 transition-colors duration-300"><i class="fab fa-youtube" aria-hidden="true"></i>
                        YouTube</a>
                    <a href="#" target="_blank" rel="noopener noreferrer"
                        class="icon flex items-center gap-2 text-gray-700 hover:text-rose-600 transition-colors duration-300"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a>
                </section>
            </section>
        </section>
    </section>
</nav>

<section class="search_module nav_close">
    <section class="inner">
        <strong class="title">Buscador</strong>

        <form class="search" role="search" method="get" id="searchform"
            action="" data-hs-cf-bound="true">
            <label for="s">Buscar</label>
            <input type="text" value="" name="s" id="s"
                placeholder="Encuentra eventos, experiencias y artículos para inspirarte">
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


