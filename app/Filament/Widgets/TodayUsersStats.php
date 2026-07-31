<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TodayUsersStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('user',
                User::whereDate('created_at', now()->toDateString())->count()
            )
                ->label('Today Users')
                ->description('Number of users registered today'),
        ];
    }
}
