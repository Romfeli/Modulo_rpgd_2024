<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Apariencia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Compartir la variable 'isLogoActive' con todas las vistas
        View::composer('*', function ($view) {
            $appearance = Apariencia::first(); // Obtener la configuración de apariencia
            $isLogoActive = $appearance ? $appearance->is_logo_active : false;

            // Pasar la variable 'isLogoActive' a la vista
            $view->with('isLogoActive', $isLogoActive);
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
