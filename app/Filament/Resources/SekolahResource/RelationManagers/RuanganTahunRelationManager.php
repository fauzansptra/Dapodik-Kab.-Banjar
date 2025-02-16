<?php

namespace App\Filament\Resources\SekolahResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;;

class RuanganTahunRelationManager extends RelationManager
{
    protected static string $relationship = 'ruanganTahun';
    protected static ?string $title = 'Data Ruangan'; // GANTI JUDUL DI TAB
    // protected static ?string $label = 'Ruangan Custom'; // GANTI LABEL SATUAN
    // protected static ?string $pluralLabel = 'Ruangan Custom'; // GANTI LABEL JAMAK

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('tahun_id')
                    ->label('Tahun')
                    ->relationship('tahun', 'tahun')
                    ->validationMessages([
                        'required' => 'Tahun wajib diisi',
                    ])
                    ->required(),

                Forms\Components\Select::make('jenis_ruangan')
                    ->options([
                        'kelas' => 'Kelas',
                        'lab' => 'Laboratorium',
                        'perpustakaan' => 'Perpustakaan',

                    ])
                    ->validationMessages([
                        'required' => 'Jenis Ruangan wajib diisi',
                    ])
                    ->label('Jenis Ruangan')
                    ->required(),
                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->validationMessages([
                        'required' => 'Jumlah wajib diisi',
                    ])
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('tahun.tahun')->label('Tahun')->sortable(),
                TextColumn::make('jenis_ruangan')->sortable(),
                TextColumn::make('jumlah'),
            ])
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
        // ->bulkActions([]);
    }

    public function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\SekolahResource\Widgets\RuanganTahunStats::class,
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['sekolah', 'tahun']);
    }
    
}
