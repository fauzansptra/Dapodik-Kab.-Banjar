<?php

namespace App\Filament\Clusters\tambahan\Resources\TahunResource\Pages;

use App\Filament\Clusters\tambahan\Resources\TahunResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTahun extends EditRecord
{
    protected static string $resource = TahunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
