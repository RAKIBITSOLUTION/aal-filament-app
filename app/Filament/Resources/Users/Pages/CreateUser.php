<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Icons\Heroicon;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getCreatedNotificationMessage(): ?string
    {
        return 'User Created';
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('New User Created')
            ->body('The user has been successfully registered.')
            ->icon(Heroicon::AcademicCap)
            ->success();
    }
}
