<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Http;

class ApiUsers extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.api-users';

    protected static ?string $title = 'API Users';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    public function table(Table $table): Table
    {
        return $table
            ->records(fn () => $this->apiData())
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('name')->label('Name'),
                TextColumn::make('email')->label('Email'),
            ]);
    }

    public function apiData()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/users');

        return $response->json();
    }
}
