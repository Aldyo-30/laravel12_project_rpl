<?php

namespace App\Filament\Resources\GalleryvideoResource\Pages;

use App\Filament\Resources\GalleryvideoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGalleryvideo extends EditRecord
{
    protected static string $resource = GalleryvideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
