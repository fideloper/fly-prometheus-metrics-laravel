<?php

namespace App\Providers;

use Prometheus\Storage\Redis;
use Prometheus\CollectorRegistry;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class PrometheusServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CollectorRegistry::class, function(Application $app): CollectorRegistry {
            Redis::setDefaultOptions(Arr::only(config('database.redis.default'), ['host', 'port', 'password']));

            return CollectorRegistry::getDefault();
        });
    }
}