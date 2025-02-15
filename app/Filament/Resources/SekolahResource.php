<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SekolahResource\Pages;
use App\Filament\Resources\SekolahResource\RelationManagers;
use App\Models\Sekolah;
use App\Models\Kecamatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use function Termwind\style;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\MultiSelectFilter;
use App\Filament\Resources\SekolahResource\Widgets\SekolahStatsWidget;
use App\Filament\Resources\SekolahResource\RelationManagers\SekolahTahunRelationManager;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;


class SekolahResource extends Resource
{
    protected static ?string $model = Sekolah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('NamaSekolah')->required(),
                TextInput::make('NPSN')->required()->label('NPSN'),
                Forms\Components\Select::make('bentuk_pendidikan')
                ->options([
                    'TK' => 'TK',
                    'KB' => 'KB',
                    'TPA' => 'TPA',
                    'SMK' => 'SMK',
                    'PKBM' => 'PKBM',
                    'SLB' => 'SLB',
                    'SKB' => 'SKB',
                    'SD' => 'SD',
                    'SMP' => 'SMP',
                    'SMA' => 'SMA',
                ])
                ->searchable()
                ->required(),
            
            Forms\Components\Select::make('status')
                ->options([
                    'Negeri' => 'Negeri',
                    'Swasta' => 'Swasta',
                ])
                ->required(),
            
            Forms\Components\Select::make('kecamatan_id')
                ->label('Kecamatan')
                ->relationship('kecamatan', 'NamaKecamatan')
                ->searchable()
                ->required(),
            
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make()
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(2)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('NamaSekolah'),
                                        Components\TextEntry::make('NPSN'),
                                        Components\TextEntry::make('BentukPendidikan')
                                            ->badge()
                                            ->color('success'),
                                    ]),
                                    Components\Group::make([
                                        Components\TextEntry::make('Status'),
                                        Components\TextEntry::make('Kecamatan.NamaKecamatan')
                                    ]),
                                ]),
                        ])->from('lg'),
                    ]),
            ]);
    }

    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('NamaSekolah')
                    ->label('Nama Sekolah')
                    ->extraAttributes(['style' => 'width: 300px;'])

                    ->sortable()
                    ->searchable(),
                TextColumn::make('NPSN')
                    ->label('NPSN')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('BentukPendidikan')
                    ->label('Bentuk Pendidikan')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('Status')
                    ->label('Status')
                    ->sortable(),
                TextColumn::make('kecamatan.NamaKecamatan')
                    ->label('Kecamatan')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('BentukPendidikan')
                ->options([
                    'TK' => 'TK',
                    'KB' => 'KB',
                    'TPA' => 'TPA',
                    'SMK' => 'SMK',
                    'PKBM' => 'PKBM',
                    'SLB' => 'SLB',
                    'SKB' => 'SKB',
                    'SD' => 'SD',
                    'SMP' => 'SMP',
                    'SMA' => 'SMA',
                ])
                ->label('Bentuk Pendidikan')
                ->placeholder('Semua')
                ->multiple(),

            SelectFilter::make('status')
                ->options([
                    'Negeri' => 'Negeri',
                    'Swasta' => 'Swasta',
                ])
                ->label('Status')
                ->placeholder('Semua'),

            SelectFilter::make('KecamatanId')
                ->options(fn() => Kecamatan::pluck('nama', 'id')->toArray())
                ->label('Kecamatan')
                ->placeholder('Semua')
                ->relationship('kecamatan', 'NamaKecamatan'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Detail'),
                Tables\Actions\EditAction::make()->label('Edit'),
                Tables\Actions\DeleteAction::make()->label('Hapus'),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SekolahTahunRelationManager::class,
        ];
    }
    public static function getWidgets(): array
    {
        return [
            SekolahStatsWidget::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSekolahs::route('/'),
            'create' => Pages\CreateSekolah::route('/create'),
            'edit' => Pages\EditSekolah::route('/{record}/edit'),
            'view' => Pages\ViewSekolah::route('/{record}'),
        ];
    }
}
