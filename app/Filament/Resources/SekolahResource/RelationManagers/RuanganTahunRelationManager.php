<?php

namespace App\Filament\Resources\SekolahResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RuanganTahunRelationManager extends RelationManager
{
    protected static string $relationship = 'RuanganTahun';

    public function form(Form $form): Form
    {
        return $form
            ->schema([


                Forms\Components\Select::make('bentuk_pendidikan')
                    ->options([
                        'kelas' => 'Kelas',
                        'lab' => 'Laboratorium',
                        'perpustakaan' => 'Perpustakaan',

                    ])
                    ->required(),
                Forms\Components\TextInput::make('jumlah')
                    ->label('Jumlah')
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['sekolah', 'tahun']);
    }
}
