<?php

namespace App\Filament\Resources\SekolahResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\models\Sekolah;
use App\Models\Tahun;
use App\models\Kecamatan;

class DashboardWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Sekolah', Sekolah::count())
                ->color('primary'),
            stat::make('Jumlah Tahun', Tahun::count())
                ->color('primary'),
            stat::make('Jumlah Kecamatan', Kecamatan::count())
        ];
    }
}
