<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

use App\Models\Evento;
use App\Models\Patrocinador; // 👈 Importamos el modelo Patrocinador
use App\Observers\EventoObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configuración regional de fechas
        Carbon::setLocale('es');

        // Registrar observadores
        Evento::observe(EventoObserver::class);

        // Compartir los patrocinadores con todas las vistas
        View::composer('*', function ($view) {
            $view->with('patrocinadores', Patrocinador::all());
        });
    }
}
