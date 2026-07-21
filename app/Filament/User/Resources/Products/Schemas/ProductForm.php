<?php

namespace App\Filament\User\Resources\Products\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),
                TextInput::make('sku'),
                TextInput::make('description'),
                TextInput::make('price'),
                TextInput::make('stock'),
                FileUpload::make('image')->disk('public')->directory('products'),
                Checkbox::make('is_active')->default(false),
                Checkbox::make('is_featured')->default(false),
            ]);
    }
}
