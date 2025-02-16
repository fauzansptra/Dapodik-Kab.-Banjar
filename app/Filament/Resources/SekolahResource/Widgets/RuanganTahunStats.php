<?php

namespace App\Filament\Resources\SekolahResource\Widgets;

use App\Models\RuanganTahun;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RuanganTahunStats extends BaseWidget
{
    
    protected function getCards(): array
    {
        $kelasData = RuanganTahun::where('jenis_ruangan', 'kelas')
            ->selectRaw('tahun_id, SUM(jumlah) as total')
            ->groupBy('tahun_id')
            ->orderBy('tahun_id')
            ->get();

        $perpustakaanData = RuanganTahun::where('jenis_ruangan', 'perpustakaan')
            ->selectRaw('tahun_id, SUM(jumlah) as total')
            ->groupBy('tahun_id')
            ->orderBy('tahun_id')
            ->get();

        $labData = RuanganTahun::where('jenis_ruangan', 'lab')
            ->selectRaw('tahun_id, SUM(jumlah) as total')
            ->groupBy('tahun_id')
            ->orderBy('tahun_id')
            ->get();

        // Ambil total terakhir untuk masing-masing jenis ruangan
        $kelasTerbaru = $kelasData->last()->total ?? 0;
        $perpustakaanTerbaru = $perpustakaanData->last()->total ?? 0;
        $labTerbaru = $labData->last()->total ?? 0;

        return [
            Stat::make('Kelas', 2000)
            // Stat::make('Kelas', $kelasTerbaru)
            //     ->description('Perkembangan jumlah kelas')
            //     ->chart($kelasData->pluck('total')->toArray())
            //     ->color('success'),

            // Stat::make('Perpustakaan', $perpustakaanTerbaru)
            //     ->description('Perkembangan jumlah perpustakaan')
            //     ->chart($perpustakaanData->pluck('total')->toArray())
            //     ->color('warning'),

            // Stat::make('Lab', $labTerbaru)
            //     ->description('Perkembangan jumlah lab')
            //     ->chart($labData->pluck('total')->toArray())
            //     ->color('danger'),
        ];
    }
}
