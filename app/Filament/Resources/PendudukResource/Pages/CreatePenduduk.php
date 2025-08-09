<?php

namespace App\Filament\Resources\PendudukResource\Pages;

use App\Filament\Resources\PendudukResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePenduduk extends CreateRecord
{
    protected static string $resource = PendudukResource::class;

    protected function handle(array $data): \Illuminate\Database\Eloquent\Model
    {
        $data['total'] = ($data['laki_laki'] ?? 0) + ($data['perempuan'] ?? 0);
        return static::getModel()::create($data);
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
