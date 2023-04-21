<?php

namespace App\Prometheus\Gauges;

use App\Prometheus\Prom;
use App\Prometheus\Metric;
use Prometheus\Gauge;

class BillableUsage extends Metric
{
    protected Gauge $collector;

    public function __construct()
    {
        $this->collector = Prom::getOrRegisterGauge('chipper', 'billage_usage', 'Billable builds', ['team']);
    }
}
