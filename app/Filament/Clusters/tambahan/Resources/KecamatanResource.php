<?php

namespace App\Filament\Clusters\tambahan\Resources;

use App\Filament\Clusters\tambahan;
use App\Filament\Clusters\tambahan\Resources\KecamatanResource\Pages;
use App\Filament\Clusters\tambahan\Resources\KecamatanResource\RelationManagers;
use App\Models\Kecamatan;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KecamatanResource extends Resource
{
    protected static ?string $model = Kecamatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = tambahan::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_kecamatan')
                    ->label('Nama Kecamatan')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_kecamatan')
                ->label('Nama Kecamatan')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->label('Hapus'),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKecamatans::route('/'),
            // 'create' => Pages\CreateKecamatan::route('/create'),
            // 'edit' => Pages\EditKecamatan::route('/{record}/edit'),
        ];
    }
}
