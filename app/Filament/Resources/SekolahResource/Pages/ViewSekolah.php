<?php

namespace App\Filament\Resources\SekolahResource\Pages;

use App\Filament\Resources\SekolahResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;

class ViewSekolah extends ViewRecord
{
    protected static string $resource = SekolahResource::class;

    protected function getRelations(): array
    {
        return [
            SekolahResource\RelationManagers\SekolahTahunRelationManager::class,
        ];
    }
//     protected function getHeaderActions(): array
// {
//     return [
//         Action::make('edit')
//             ->label('Edit Sekolah')
//             ->url(fn () => static::getResource()::getUrl('edit', ['record' => $this->record])),
//     ];
// }

}
