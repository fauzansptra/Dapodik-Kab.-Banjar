<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;
    protected static ?string $title = 'Beranda';


    public function filtersForm(Form $form): Form
    {
    $tahun=Carbon::now()->year;
    $tahun_id=\App\Models\Tahun::where('tahun',$tahun)->first()->id;
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('tahun_id')
                            ->label('Tahun')
                            ->options(function () {
                                return \App\Models\Tahun::query()
                                    ->pluck('tahun', 'id');
                            })
                            ->default($tahun_id)
                            ->searchable()
                            ->preload()
                            ->columnSpan(4),
                    ])
                    ->columns(4),
            ]);
    }

    // public function widgets(): array
    // {
    //     return [
    //         \App\Filament\Widgets\dashboardStatWidget::class,

    //     ];
    // }
    protected function getHeaderWidgets(): array
    {
        return [
            // \App\Filament\Widgets\dashboardStatWidget::class,
            \App\Filament\Resources\SekolahResource\Widgets\DashboardWidget::class,
        ];
    }
}
