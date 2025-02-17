<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Resources\SekolahResource\Widgets\SekolahStatsWidget;

class Insight extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.insight'; 
    protected function getHeaderWidgets(): array
    {
        return [
            SekolahStatsWidget::class,
        ];
    }

    // Daftarkan widget di footer (opsional)
    protected function getFooterWidgets(): array
    {
        return [
            // Tambahkan widget lain di sini jika diperlukan
        ];
    }
}
