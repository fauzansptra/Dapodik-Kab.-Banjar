<?php

namespace App\Filament\Resources\SekolahResource\Widgets;

use App\Models\Sekolah;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SekolahStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Sekolah', Sekolah::count())
            ->color('primary'),
        ];
    }
}
