<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

use App\Models\SekolahTahun;

class DashboardStatWidget extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        $filters = $this->filters;
        $tahunId = $filters['tahun_id'] ?? null;

        $query = SekolahTahun::query();

        if ($tahunId) {
            $query->where('tahun_id', $tahunId);
        }

        $totalSiswa = $query->sum('jml_peserta_didik');
        $totalGuru = $query->sum('jml_guru');
        $totalPegawai = $query->sum('jml_pegawai');
        $totalRombel = $query->sum('jml_rombel');
        $totalKelas = $query->sum('jml_kelas');
        $totalLab = $query->sum('jml_lab');
        $totalPerpustakaan = $query->sum('jml_perpustakaan');

        return [
            Stat::make('Jumlah Siswa', $totalSiswa)
                ->color('primary')
                ->icon('heroicon-s-academic-cap'),
            Stat::make('Jumlah Guru', $totalGuru)
                ->color('success')
                ->icon('heroicon-s-user-group'),
            Stat::make('Jumlah Pegawai', $totalPegawai)
                ->color('warning')
                ->icon('heroicon-s-users'),
            Stat::make('Jumlah Rombel', $totalRombel)
                ->color('danger')
                ->icon('heroicon-m-rectangle-stack'),
            Stat::make('Jumlah Kelas', $totalKelas)
                ->color('primary')
                ->icon('heroicon-s-academic-cap'),
            Stat::make('Jumlah Lab', $totalLab)
                ->color('success')
                ->icon('heroicon-s-beaker'),
            Stat::make('Jumlah Perpustakaan', $totalPerpustakaan)
                ->color('warning')
                ->icon('heroicon-s-book-open'),
        ];
    }
}
