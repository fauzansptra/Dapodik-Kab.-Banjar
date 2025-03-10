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

use function Laravel\Prompts\text;

class SekolahTahunRelationManager extends RelationManager
{
    protected static string $relationship = 'SekolahTahun';
    protected static ?string $title = 'Detail Sekolah Per Tahun'; // GANTI JUDUL DI TAB
    public function isReadOnly(): bool
    {
        // return false;
        return Str::of($this->pageClass)->contains('ViewSekolah'); //only on the ViewPage
    }


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
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('jml_peserta_didik')
                    ->label('Peserta Didik')
                    ->validationMessages([
                        'required' => 'Peserta Didik wajib diisi',
                    ])
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('jml_guru')
                    ->label('Guru')
                    ->validationMessages([
                        'required' => 'Guru wajib diisi',
                    ])
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('jml_pegawai')
                    ->label('Pegawai')
                    ->validationMessages([
                        'required' => 'Pegawai wajib diisi',])
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('jml_rombel')
                    ->label('Rombel')
                    ->validationMessages([
                        'required' => 'Rombel wajib diisi',
                    ])  
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('jml_kelas')
                ->label('Kelas')
                    ->validationMessages([
                        'required' => 'Kelas wajib diisi',
                    ])
                    ->numeric()
                    ->required(),
                
                    Forms\Components\TextInput::make('jml_lab')
                    ->label('Lab')
                    ->validationMessages([
                        'required' => 'Lab wajib diisi',
                    ])
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('jml_perpustakaan')
                    ->label('Perpustakaan')
                    ->validationMessages([
                        'required' => 'Perpustakaan wajib diisi',
                    ])
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
                textColumn::make('jml_kelas')->label('Kelas'),
                textColumn::make('jml_lab')->label('Lab'),
                textColumn::make('jml_perpustakaan')->label('Perpustakaan'),
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
