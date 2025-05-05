<?php

namespace EncoreDigitalGroup\LaravelCachePrune\Providers;

use EncoreDigitalGroup\LaravelCachePrune\Console\Commands\CachePruneCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->commands([
            CachePruneCommand::class,
        ]);
    }
}
