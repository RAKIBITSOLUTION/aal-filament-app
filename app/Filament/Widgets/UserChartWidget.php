<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UserChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;

    use InteractsWithPageFilters;

    protected ?string $heading = 'User Chart Widget';

    protected ?string $maxHeight = '375px';

    // Line Colour
    protected string $color = 'info';

    protected function getData(): array
    {

        $startDate = $this->pageFilters['startDate'] ?? null;
        $endDate = $this->pageFilters['endDate'] ?? null;

        $start = $startDate ? now()->parse($startDate)->startOfDay() : now()->startOfMonth();
        $end = $endDate ? now()->parse($endDate)->endOfDay() : now()->endOfMonth();

        $data = Trend::model(User::class)
            ->between(
                start: $start,
                end: $end,
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'User created',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
