<?php

namespace App\Filament\Resources\SekolahResource\Widgets;

use App\Models\Sekolah;
use App\Filament\Resources\SekolahResource\Pages\ListSekolahs;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;


class SekolahStatsWidget extends BaseWidget
{
    use InteractsWithPageTable;
    protected function getTablePage(): string
    {
        return ListSekolahs::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Sekolah', $this->getPageTableQuery()->count())
            ->color('primary'),
        ];
    }
}
