<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->title('User Deleted Successfully')
                        ->body('The user has been successfully deleted.')
                        ->icon(Heroicon::AcademicCap)
                        ->success()
                ),
        ];
    }

    protected function getSavedNotificationMessage(): ?string
    {
        return 'User updated successfully.';
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('User UPDATE')
            ->body('The user has been successfully updated.')
            ->icon(Heroicon::AcademicCap)
            ->success()
            ->send();
    }
}
