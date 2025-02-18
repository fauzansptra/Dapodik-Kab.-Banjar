<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use App\Models\SekolahTahun;

class distribusiRuang extends ChartWidget
{

    use InteractsWithPageFilters;
    protected static ?string $heading = 'Distribusi Ruang';

    protected function getData(): array
    {
        $filters = $this->filters;
        $tahunId = $filters['tahun_id'] ?? null;

        $query = SekolahTahun::query();

        if ($tahunId) {
            $query->where('tahun_id', $tahunId);
        }

        $totalKelas = $query->sum('jml_kelas');
        $totalLab = $query->sum('jml_lab');
        $totalPerpustakaan = $query->sum('jml_perpustakaan');
        return [
            'datasets' => [
                [
                    'label' => 'Ruang',
                    'data' => [$totalKelas, $totalLab, $totalPerpustakaan],
                    'backgroundColor' => ['#3490dc', '#38c172', '#f6993f'],
                    'fill' => 'start',
                ],
            ],
            'labels' => ['Kelas', 'Lab', 'Perpustakaan']
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
