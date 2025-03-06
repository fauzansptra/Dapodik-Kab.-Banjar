<?php

namespace App\Filament\Resources\SekolahResource\Pages;

use App\Filament\Resources\SekolahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSekolah extends EditRecord
{
    protected static string $resource = SekolahResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\DeleteAction::make(),
    //         Actions\Action::make('view')
    //             ->label('Detail Sekolah')
    //             ->url(fn () => static::getResource()::getUrl('view', ['record' => $this->record])),
    //     ];
    // }
}
