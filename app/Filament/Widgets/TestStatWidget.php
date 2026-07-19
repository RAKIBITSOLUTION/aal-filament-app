<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TestStatWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('This is a test stat')
                ->descriptionIcon('heroicon-o-users', IconPosition::Before)
                ->descriptionColor('success')
                ->chart(
                    User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->whereYear('created_at', now()->year)
                        ->groupBy('month')
                        ->orderBy('month')
                        ->pluck('count')
                        ->toArray()
                )
                ->color('success'),

            Stat::make('Total Posts', Post::count())
                ->description('This is a test stat')
                ->descriptionIcon('heroicon-o-users', IconPosition::Before)
                ->descriptionColor('primary')
                ->chart(
                    Post::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->whereYear('created_at', now()->year)
                        ->groupBy('month')
                        ->orderBy('month')
                        ->pluck('count')
                        ->toArray()
                )
                ->color('primary'),

            Stat::make('Total Products', Product::count())
                ->description('This is a test stat')
                ->descriptionIcon('heroicon-o-users', IconPosition::Before)
                ->descriptionColor('info')
                ->chart(
                    Product::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->whereYear('created_at', now()->year)
                        ->groupBy('month')
                        ->orderBy('month')
                        ->pluck('count')
                        ->toArray()
                )
                ->color('info'),
        ];
    }
}
