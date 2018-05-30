<?php
namespace Bytepath\FlashBang;

use Bytepath\FlashBang\Flasher;
use Illuminate\Log\Logger;
use Illuminate\Session\SessionManager;
use Illuminate\Support\ServiceProvider;

class FlashBangServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . "/Views", "flashbang");
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Flasher::class, function($app){
            $log = $app->make(Logger::class);
            $session =  $app->make(SessionManager::class);
            return new Flasher($log, $session);
        });
    }
}
