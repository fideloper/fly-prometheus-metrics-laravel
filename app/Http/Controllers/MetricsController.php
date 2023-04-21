<?php

namespace App\Http\Controllers;

use App\Prometheus\Prom;
use Illuminate\Http\Request;
use Prometheus\RenderTextFormat;

class MetricsController extends Controller
{
    public function __invoke(Request $request)
    {
        return response(
            (new RenderTextFormat)->render(Prom::getMetricFamilySamples()),
            200,
            [
                'Content-Type' => RenderTextFormat::MIME_TYPE,
            ]
        );
    }
}
