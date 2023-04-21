# Fly.io Prometheus Metrics

An example repository showing how to instrument a Laravel application, so it creates Prometheus metrics.

There are a few elements:

1. Creates a `/metrics` endpoint for Prometheus to scrape
2. Stores metrics in Redis so they persist long enough for Prometheus to get when periodically calling the `/metrics` endpoint
3. Generates user (programmer) defined metrics

## The Code

In this specific repository, we use the [`promphp/prometheus_client_php`](https://github.com/PromPHP/prometheus_client_php) composer package in Laravel.

Files to check out:

1. `app/Providers/PrometheusServiceProvider` - registered in `config/app.php`, creates a singleton for the Prometheus library `CollectorRegistry` class (the main one you use for that library)
    - Also sets up Redis to persist metrics
2. `app/Prometheus` - classes corresponding to metrics created in the app, along with the `Prom` facade
3. `app/Http/Controllers/Metrics.php` - The controller that generates metrics output for Prometheus to read at the `/metrics` route, registered in `routes/web.php`
4. `app/Console/Commands/GenerateMetricsCommand.php` - A console command, called every few minutes by the scheduler. This generate some metrics with some randomness, simulating what might be real-ish metrics.

> The metrics this app collects is related to the corresponding article found at [https://fly.io/laravel-bytes](https://fly.io/laravel-bytes).
