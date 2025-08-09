<?php

namespace App\Filament\Resources\GalleryvideoResource\Pages;

use App\Filament\Resources\GalleryvideoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGalleryvideo extends CreateRecord
{
    protected static string $resource = GalleryvideoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
