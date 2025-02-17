<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Dashboard extends BaseDashboard
{
    use BaseDashboard\Concerns\HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
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
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(3),
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
