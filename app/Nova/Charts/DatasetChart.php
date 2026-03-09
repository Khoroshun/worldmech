<?php

namespace App\Nova\Charts;

use Coroowicaksono\ChartJsIntegration\LineChart;

class DatasetChart extends LineChart
{
    public $width = 'full';

    public function __construct()
    {
        parent::__construct();

        $this->title('Test Chart');
    }

    public function data(): array
    {
        return [
            'labels' => [10, 20, 30, 40, 50],
            'datasets' => [
                [
                    'label' => 'Test Dataset',
                    'data' => [1, 4, 2, 6, 3],
                    'borderColor' => '#2563eb',
                    'fill' => false,
                ],
            ],
        ];
    }
}
