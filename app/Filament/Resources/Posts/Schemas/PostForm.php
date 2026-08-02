<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Post Details')
                    ->description('Fill all the fields')
                    ->icon(Heroicon::RocketLaunch)
                    ->schema([
                        Group::make()
                            ->schema([
                                TextInput::make('title')->rules(['required', 'string', 'max:255'])
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, string $state, Set $set, Get $get) {
                                        // dd($operation, $state);
                                        $set('slug', Str::slug($state));
                                        dd($get('category_id'));
                                    }),
                                TextInput::make('slug'),
                                Select::make('category_id')
                                    ->label('Category')
                                    ->relationship('category', 'name')
                                    ->preload()
                                    ->searchable(),
                            ])->columns(2),

                       // MarkdownEditor::make('body'),
                        Textarea::make('body')->maxLength(255),
                    ])->columnSpan(2),

                Group::make()
                    ->schema([
                        Section::make('Post Media')
                            ->description('Upload media files')
                            ->icon(Heroicon::Photo)
                            ->schema([
                                FileUpload::make('image')->disk('public'),
                                ColorPicker::make('color'),
                            ]),
                        Section::make('Post Settings')
                            ->description('Configure post settings')
                            ->icon(Heroicon::Cog)
                            ->schema([
                                Select::make('tags')
                                    ->relationship('tags', 'name')
                                    ->multiple()
                                    ->preload(),
                                Checkbox::make('published'),
                                DatePicker::make('published_at'),
                            ]),

                    ])->columnSpan(1),

            ])->columns(3);
    }
}