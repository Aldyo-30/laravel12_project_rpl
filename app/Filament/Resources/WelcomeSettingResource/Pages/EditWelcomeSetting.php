<?php

namespace App\Filament\Resources\WelcomeSettingResource\Pages;

use App\Filament\Resources\WelcomeSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWelcomeSetting extends EditRecord
{
    protected static string $resource = WelcomeSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
