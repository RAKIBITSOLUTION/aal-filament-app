<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserCounterWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::all()->count()),
            Stat::make('Total User from Bangladesh', User::whereHas('country', fn($query) => $query->where('name', 'Bangladesh'))->count()),
            Stat::make('Total User from India', User::whereHas('country', fn($query) => $query->where('name', 'India'))->count()),
        ];
    }
}