<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('layouts.navigation', function ($view) {

            $lowStockProducts = Product::where('stock', '<=', 5)
                ->orderBy('stock', 'asc')
                ->orderBy('name', 'asc')
                ->get();

            $lowStockCount = $lowStockProducts->count();

            $view->with([
                'lowStockProducts' => $lowStockProducts,
                'lowStockCount' => $lowStockCount,
            ]);
        });
    }
}