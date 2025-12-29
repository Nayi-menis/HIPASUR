<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use App\Models\Almacen; 

class AppServiceProvider extends ServiceProvider
{
    public function register(): void 
    { 

    }

    public function boot(): void
    {
        // Compartir las alertas de stock con todas las vistas del sistema
        view()->composer('*', function ($view) {
            // Solo ejecutamos si la tabla existe (evita errores en instalaciones limpias)
            if (\Illuminate\Support\Facades\Schema::hasTable('almacens')) {
                
                // Lógica: Alerta cuando el stock es menor o igual al mínimo
                $productosBajoStock = \App\Models\Almacen::whereColumn('stock', '<=', 'stock_minimo')
                    ->get();
                
                // Pasamos las variables a la campanita del layout
                $view->with('productosBajoStock', $productosBajoStock)
                    ->with('totalNotificaciones', $productosBajoStock->count());
            }
        });
    }
}
