<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Product Info')
                            ->icon(Heroicon::InformationCircle)
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold')->color('primary'),
                                TextEntry::make('sku')
                                    ->label('SKU')
                                    ->weight('bold')->color('primary'),
                                TextEntry::make('price')
                                    ->label('Price')
                                    ->weight('bold')->color('primary'),
                                TextEntry::make('stock')
                                    ->label('Stock')
                                    ->weight('bold')->color('primary'),
                            ]),

                        Tab::make('Price Info')
                            ->icon(Heroicon::CurrencyDollar)
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Price'),
                                TextEntry::make('stock')
                                    ->label('Stock'),
                            ]),

                        Tab::make('Media Info')
                            ->icon(Heroicon::Photo)
                            ->schema([
                                ImageEntry::make('image')
                                    ->disk('public')
                                    ->label('Product Image'),
                            ]),

                    ])->columnSpanFull(),
            ]);
    }
}
