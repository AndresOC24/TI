<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsistenciaTrabajadorResource\Pages;
use App\Filament\Resources\AsistenciaTrabajadorResource\RelationManagers;
use App\Models\AsistenciaTrabajador;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AsistenciaTrabajadorResource extends Resource
{
    protected static ?string $model = AsistenciaTrabajador::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Asistencias';

    // Agrega esta función para cambiar el nombre en el menú de navegación
    public static function getNavigationLabel(): string
    {
        return 'Asistencia Colaboradores';
    }

    public static function getModelLabel(): string
    {
        return 'Asistencia Colaboradores'; // Nombre en singular
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->required()
                    ->relationship('user', 'name'),
                Forms\Components\DatePicker::make('fecha')
                    ->required(),
                Forms\Components\TextInput::make('ingreso')
                    ->required(),
                Forms\Components\TextInput::make('salida'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nombre'),
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ingreso'),
                Tables\Columns\TextColumn::make('salida'),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])

            ->actions([

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
            'index' => Pages\ListAsistenciaTrabajadors::route('/'),
            'create' => Pages\CreateAsistenciaTrabajador::route('/create'),
            'edit' => Pages\EditAsistenciaTrabajador::route('/{record}/edit'),
        ];
    }
}
