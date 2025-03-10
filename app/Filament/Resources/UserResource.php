<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Lainnya';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('role')
                    ->label('Role')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state === 'admin_sekolah' ? 'Admin Sekolah' : ucfirst($state)),
                TextColumn::make('Sekolah.nama_sekolah')
                    ->label('Admin Sekolah')
                    ->searchable()
                    // ->formatStateUsing(
                    //     fn($state, $record) =>
                    //     $record->sekolah_id!==null ? $state : '-'
                    // )
                    ->default(fn($record)=>
                    $record->role==='superadmin'?'Superadmin': ($record->role==='guest'?'Guest':'-')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    // public static function shouldRegisterNavigation(): bool
    // {
    //     $user = \Illuminate\Support\Facades\Auth::user();
    //     if ($user->role !== 'superadmin') {
    //         return false;
    //     }
    //     return static::canAccessClusteredComponents();
    // }

}
