<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('step-1')
                        ->icon(Heroicon::PresentationChartBar)
                        ->description('Product Information')
                        ->schema([
                            Group::make()
                                ->schema([
                                    TextInput::make('name')->required(),
                                    TextInput::make('sku'),
                                ])->columns(2),
                            MarkdownEditor::make('description'),
                        ]),

                    Step::make('step-2')
                        ->description('Product Price')

                        ->schema([
                            Group::make()
                                ->schema([
                                    TextInput::make('price'),
                                    TextInput::make('stock'),
                                ])->columns(2),
                        ]),
                    Step::make('step-3')
                        ->description('Product Media')

                        ->schema([
                            Group::make()
                                ->schema([
                                    FileUpload::make('image')->disk('public')->directory('products'),
                                    Checkbox::make('is_active')->default(false),
                                    Checkbox::make('is_featured')->default(false),
                                ]),
                        ]),

                ])
                    ->columnSpanFull()
                    ->skippable()
                    ->submitAction(
                        Action::make('Save')
                            ->label('Create Product')
                            ->button()
                            ->color('primary')
                            ->submit('save')
                    ),
            ]);
    }
}