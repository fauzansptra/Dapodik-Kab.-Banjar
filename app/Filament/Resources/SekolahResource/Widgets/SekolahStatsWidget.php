<?php

namespace App\Filament\Resources\SekolahResource\Widgets;

use App\Models\Sekolah;
use App\Models\Tahun;
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
        $all=$this->getPageTableQuery();
        $negeri=$this->getPageTableQuery()->where('status','Negeri');
        $swasta=$this->getPageTableQuery()->where('status','Swasta');
        // $pesertaDidik=$query->sum('sekolah_tahun.jml_peserta_didik');
        return [
            Stat::make('Total Sekolah', $all->count())
            ->color('primary'),
            Stat::make('Sekolah Negeri', $negeri->count())
            ->color('primary'),
            Stat::make('Sekolah Swasta', $swasta->count())
            ->color('primary'),
            // Stat::make('Jumlah Peserta Didik', $pesertaDidik)
            // ->color('primary'),
        ];
    }
}
