<?php

namespace Brainr\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Carbon\Laravel\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class DevServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        if ($this->app->environment() !== 'development')
            return;

        $this->app->register(IdeHelperServiceProvider::class);
    }
}
