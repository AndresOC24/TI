<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistroBecarioResource\Pages;
use App\Models\RegistroBecario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class RegistroBecarioResource extends Resource
{
    protected static ?string $model = RegistroBecario::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Registros';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Becario')
                    ->disabled()
                    ->required(),
                Forms\Components\TextInput::make('horas_total')
                    ->numeric()
                    ->label('Total Horas')
                    ->default(0)
                    ->disabled(fn () => !Auth::user()->hasRole('Administrador')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Becario')
                    ->sortable(),
                Tables\Columns\TextColumn::make('horas_total')
                    ->label('Total Horas')
                    ->formatStateUsing(fn ($state) => round($state, 2) . ' hrs')
                    ->sortable(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRegistroBecarios::route('/'),
            'create' => Pages\CreateRegistroBecario::route('/create'),
            'edit' => Pages\EditRegistroBecario::route('/{record}/edit'),
        ];
    }
}
