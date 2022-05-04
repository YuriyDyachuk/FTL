<?php

namespace App\Providers;

use App\Models\Entities\ClientRequests;
use App\Models\Entities\GettingAct;
use App\Models\Entities\Order;
use App\Models\Observers\ClientRequestObserver;
use App\Models\Observers\GettingActObserver;
use App\Models\Observers\OrderObserver;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;

//use Laravel\Dusk\DuskServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
        if (!$this->app->environment('testing', 'production')) {
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @param  Dispatcher  $events
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $this->registerObservers();
    }

    private function registerObservers()
    {
        Order::observe(OrderObserver::class);
        GettingAct::observe(GettingActObserver::class);
        ClientRequests::observe(ClientRequestObserver::class);
    }
}
