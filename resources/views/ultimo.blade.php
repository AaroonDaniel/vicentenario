<!-- resources/views/index.blade.php -->
@extends('layouts.principal')

@section('title', 'Vicentenario Bolivia')

@section('content')
<section class="content">

    
    <section id="single" class="inner displaysponsors" data-author="rosegueda" data-id="149814">
        <section class="col_aside">        
            <article class="article">
                <a href="#" class="breadcrumb">Conoce Bolivia</a>
                <h1>{{ $novedad->titulo }}</h1>

                <section class="info_article">
                    <div class="destinations_article">
                        <a href="https://en.wikipedia.org/wiki/Bolivia" class="btn secondary"><i class="fas fa-map-marker"></i>{{ $novedad->departamento }}</a>
                    </div>
                </section>
                <!-- rrss -->
                <section class="share" data-link="#">
                    <section class="share_btns">
                        <a title="Facebook" href="#" target="_blank" rel="noopener nofollow">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a title="Twitter" href="#" target="_blank" rel="noopener nofollow">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a title="Pinterest" href="#" target="_blank" rel="noopener nofollow">
                            <i class="fab fa-pinterest"></i>
                        </a>
                        <a title="WhatsApp" href="#" target="_blank" rel="noopener nofollow">
                            <i class="fab fa-whatsapp"></i>
                        </a>          
                    </section>
                </section>

                <!-- text -->    
                <section class="text" data-gtm-vis-recent-on-screen32626292_16="118" data-gtm-vis-first-on-screen32626292_16="118" data-gtm-vis-total-visible-time32626292_16="100" data-gtm-vis-has-fired32626292_16="1">
                    <figure class="principal">
                        <img src="{{ asset('storage/' . $novedad->imagen) }}" alt="Imagen" title="{{ $novedad->titulo }}" 
                        data-credit="FIA AZTECA" data-alt="">
                        <figcaption>
                            <span class="rights">© FT. BO</span>
                            <span class="caption"></span>	
                        </figcaption>
                    </figure>
                    
                    <section class="content_note">                           
                        <p>
                        <strong>
                            {{ $novedad->descripcion }}
                        </strong>
                        </p>                     
                        
                        <blockquote class="wp-block-quote is-layout-flow wp-block-quote-is-layout-flow">
                            <p> {{ $novedad->descripcion }}</p>
                        </blockquote>
                            
                        <section class="engage">
                            <div class="share_alt">
                                <button class="btn terciary show_share">
                                    <i class="fas fa-share-alt"></i>
                                    <span>Compartir</span>
                                </button>
                                <a title="Facebook" href="&amp;display=page" target="_blank" rel="noopener nofollow"><i class="fab fa-facebook"></i></a>
                                <a title="Twitter" href="#" target="_blank" rel="noopener nofollow"><i class="fab fa-twitter"></i></a>
                                <a title="Pinterest" href="#" target="_blank" rel="noopener nofollow"><i class="fab fa-pinterest"></i></a>
                                <a title="WhatsApp" href="#" target="_blank" rel="noopener nofollow"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </section>
                        

                    </section>



                </section><!-- text -->
            </article>
        </section>


        <aside>
            @if($novedades->count())
                <section class="related"> 
                    @foreach($novedades as $novedad)                  
                    <a href="{{ route('novedades.show1', $novedad->id) }}" class="especial">
                        <figure>
                            <img src="{{ asset('storage/' . $novedad->imagen) }}" alt="Imagen de {{ $novedad->titulo }}" title="{{ $novedad->titulo }}" data-credit="Sectur Guerrero" data-alt="">
                        </figure>
                        <figcaption>
                            <b>Conoce: Bolivia</b>
                            
                            <em><i class="fas fa-map-marker"></i> {{ $novedad->departamento }}</em>
                            <strong>{{ Str::limit($novedad->descripcion, 20) }}</strong>
                        </figcaption>
                    </a>
                    @endforeach
                </section>
            @else
                <p class="text-gray-500">No hay novedades disponibles.</p>
            @endif
        </aside>
    </section>


</section>
@endsection