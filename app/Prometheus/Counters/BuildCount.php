<?php

namespace App\Prometheus\Counters;

use App\Prometheus\Prom;
use App\Prometheus\Metric;
use Prometheus\Counter;

class BuildCount extends Metric
{
    protected Counter $collector;

    public function __construct()
    {
        $this->collector = Prom::getOrRegisterCounter('chipper', 'build_count', 'Builds started', ['team', 'platform']);
    }
}
