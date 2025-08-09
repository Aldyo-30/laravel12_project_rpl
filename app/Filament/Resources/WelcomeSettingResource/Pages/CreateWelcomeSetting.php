<?php

namespace App\Filament\Resources\WelcomeSettingResource\Pages;

use App\Filament\Resources\WelcomeSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWelcomeSetting extends CreateRecord
{
    protected static string $resource = WelcomeSettingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
