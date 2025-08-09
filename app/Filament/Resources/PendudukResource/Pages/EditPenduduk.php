<?php

namespace App\Filament\Resources\PendudukResource\Pages;

use App\Filament\Resources\PendudukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenduduk extends EditRecord
{
    protected static string $resource = PendudukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handle(array $data): \Illuminate\Database\Eloquent\Model
    {
        $data['total'] = ($data['laki_laki'] ?? 0) + ($data['perempuan'] ?? 0);
        $this->record->update($data);
        return $this->record;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
