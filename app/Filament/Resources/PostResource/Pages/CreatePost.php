<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Berita Berhasil dibuat';
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
