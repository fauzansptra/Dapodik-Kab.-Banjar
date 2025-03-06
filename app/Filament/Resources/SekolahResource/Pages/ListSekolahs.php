<?php

namespace App\Filament\Resources\SekolahResource\Pages;

use App\Filament\Resources\SekolahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SekolahResource\Widgets\SekolahStatsWidget;
use Filament\Pages\Concerns\ExposesTableToWidgets;


class ListSekolahs extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = SekolahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            SekolahStatsWidget::class,
        ];
    }
}
