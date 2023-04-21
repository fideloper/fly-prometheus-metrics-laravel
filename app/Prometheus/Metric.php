<?php

namespace App\Prometheus;


abstract class Metric
{
    public function __call($method, $args)
    {
        return $this->collector->$method(...$args);
    }

    public static function __callStatic($method, $args)
    {
        return (new static)->$method(...$args);
    }
}
