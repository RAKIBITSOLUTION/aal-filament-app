<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Information')
                    ->schema([
                        TextEntry::make('name')->weight('bold')->label('Product Name'),
                        TextEntry::make('sku')->label('SKU'),
                        TextEntry::make('price')->label('Price'),
                        TextEntry::make('stock')->label('Stock'),
                    ]),
                Section::make('Media Information')
                    ->schema([
                        ImageEntry::make('image')->disk('public'),
                    ]),

            ]);

    }
}
