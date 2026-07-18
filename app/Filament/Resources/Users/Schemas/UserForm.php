<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true), // Prevents duplicate email registration

                        TextInput::make('password')
                            ->password()
                            ->required(),
                    ]),

                Section::make('Location')
                    ->schema([
                        Select::make('country_id')
                            ->label('Country')
                            ->options(Country::pluck('name', 'id'))
                            ->reactive()
                            ->required(),

                        Select::make('state_id')
                            ->label('State')
                            ->options(function (callable $get) {
                                $countryId = $get('country_id');

                                return State::where('country_id', $countryId)->pluck('name', 'id');
                            })
                            ->reactive()
                            ->required(),

                        Select::make('city_id')
                            ->label('City')
                            ->options(function (callable $get) {
                                $stateId = $get('state_id');

                                return City::where('state_id', $stateId)->pluck('name', 'id');
                            })
                            ->reactive()
                            ->required(),
                    ]),

            ]);
    }
}
