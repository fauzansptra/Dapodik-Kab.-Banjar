<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\SekolahTahun;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class distribusiOrang extends ChartWidget
{
    use InteractsWithPageFilters;
    protected static ?string $heading = 'Distribusi Orang';

    protected static ?string $maxHeight = '2';

    

    protected function getData(): array
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
        return [
            'datasets' => [
                [
                    'label' => 'Orang',
                    'data' => [$totalSiswa, $totalGuru, $totalPegawai],
                    'backgroundColor' => ['#3490dc', '#38c172', '#f6993f'],
                    'fill' => 'start',
                ],
            ],
            'labels' => ['Siswa', 'Guru', 'Pegawai'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
