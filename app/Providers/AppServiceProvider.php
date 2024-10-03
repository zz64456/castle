<?php

namespace App\Providers;

use App\Repositories\Contracts\CurrencyOrderRepositoryInterface;
use App\Repositories\CurrencyOrderRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CurrencyOrderRepositoryInterface::class, CurrencyOrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
