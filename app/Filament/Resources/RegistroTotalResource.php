<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistroTotalResource\Pages;
use App\Models\RegistroTotal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth; // ✅ Corregida la importación de Auth

class RegistroTotalResource extends Resource
{
    protected static ?string $model = RegistroTotal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Registros';

    public static function getNavigationLabel(): string
    {
        return 'Registro Laborales';
    }

    public static function getModelLabel(): string
    {
        return 'Registro Laborales';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Trabajador')
                    ->required()
                    ->disabled(), // El usuario no debe poder cambiar el trabajador

                Forms\Components\TextInput::make('total_tiempo')
                    ->numeric()
                    ->label('Total Horas')
                    ->default(0)
                    ->disabled(fn () => !Auth::user()->hasRole('Administrador')), // ✅ Solo editable si es admin

                Forms\Components\TextInput::make('saldo')
                    ->numeric()
                    ->label('Saldo (Minutos)')
                    ->default(0)
                    ->disabled(fn () => !Auth::user()->hasRole('Administrador')), // ✅ Solo editable si es admin
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Colaborador')
                    ->sortable(),

                Tables\Columns\TextColumn::make('saldo')
                    ->label('Saldo (Minutos)')
                    ->formatStateUsing(fn ($state) => $state . ' min')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_tiempo')
                    ->label('Total Horas')
                    ->formatStateUsing(fn ($state) => round($state / 60, 2) . ' hrs')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // ✅ Permitir edición
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
            'index' => Pages\ListRegistroTotals::route('/'),
            'create' => Pages\CreateRegistroTotal::route('/create'),
            'edit' => Pages\EditRegistroTotal::route('/{record}/edit'),
        ];
    }
}
