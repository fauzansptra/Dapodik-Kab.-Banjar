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
use Illuminate\Support\Str;


class SekolahTahunRelationManager extends RelationManager
{
    protected static string $relationship = 'SekolahTahun';
    public function isReadOnly(): bool
    {
        // return false;
        return Str::of($this->pageClass)->contains('ViewSekolah'); //only on the ViewPage
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('jml_peserta_didik')
                    ->label('Peserta Didik')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('jml_guru')
                    ->label('Guru')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('jml_pegawai')
                    ->label('Pegawai')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('jml_rombel')
                    ->label('Rombel')
                    ->numeric()
                    ->required(),

            ]);
    }

    public function table(Table $table): Table
    {

        return $table
            // ->recordTitleAttribute('tahun')
            ->columns([
                TextColumn::make('Tahun.tahun')->label('Tahun'),
                TextColumn::make('jml_peserta_didik')->label('Peserta Didik'),
                TextColumn::make('jml_guru')->label('Guru'),
                TextColumn::make('jml_pegawai')->label('Pegawai'),
                TextColumn::make('jml_rombel')->label('Rombel'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
        // ->bulkActions([
        //     Tables\Actions\BulkActionGroup::make([
        //         Tables\Actions\DeleteBulkAction::make(),
        //     ]),
        // ]);
    }
}
