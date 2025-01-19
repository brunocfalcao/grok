<?php

namespace Nidavellir\Grok;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class GrokServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutes();

        $this->loadViewsFrom(__DIR__.'/../views', 'grok');
    }

    protected function loadRoutes()
    {
        Route::middleware([
            'api',
        ])
            ->group(function () {
                include __DIR__.'/../routes/api.php';
            });

        Route::middleware([
            'web',
        ])
            ->group(function () {
                include __DIR__.'/../routes/web.php';
            });
    }
}
