<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class UserPieChartWidget extends ChartWidget
{
    protected static ?int $sort = 3;

    protected ?string $heading = 'Country Pie Chart Widget';

    protected ?string $maxHeight = '280px';

    protected function getData(): array
    {
        return [

            'datasets' => [
                [
                    'label' => 'Country created',
                    'data' => [5, 10, 20],
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                    ],
                ],
            ],
            'labels' => ['Bangladesh', 'India', 'USA'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
