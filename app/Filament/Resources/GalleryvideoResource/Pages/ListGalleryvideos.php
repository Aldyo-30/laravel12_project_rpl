<?php

namespace App\Filament\Resources\GalleryvideoResource\Pages;

use App\Filament\Resources\GalleryvideoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGalleryvideos extends ListRecords
{
    protected static string $resource = GalleryvideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
