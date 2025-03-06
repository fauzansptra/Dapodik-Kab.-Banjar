<?php

namespace App\Filament\Clusters\tambahan\Resources\KecamatanResource\Pages;

use App\Filament\Clusters\tambahan\Resources\KecamatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKecamatans extends ListRecords
{
    protected static string $resource = KecamatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
