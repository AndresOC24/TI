<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HorarioRegularResource\Pages;
use App\Filament\Resources\HorarioRegularResource\RelationManagers;
use App\Models\HorarioRegular;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HorarioRegularResource extends Resource
{
    protected static ?string $model = HorarioRegular::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Horarios';

    // Agrega esta función para cambiar el nombre en el menú de navegación
    public static function getNavigationLabel(): string
    {
        return 'Horario Establecidos';
    }

    public static function getModelLabel(): string
    {
        return 'Horario Establecidos'; // Nombre en singular
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Usuario')
                    ->required()
                    ->relationship('user', 'name'),
                Forms\Components\TimePicker::make('ingreso')
                    ->required(),
                Forms\Components\TimePicker::make('salida')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                ->label('Usuario'),
                Tables\Columns\TextColumn::make('ingreso'),
                Tables\Columns\TextColumn::make('salida'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListHorarioRegulars::route('/'),
            'create' => Pages\CreateHorarioRegular::route('/create'),
            'edit' => Pages\EditHorarioRegular::route('/{record}/edit'),
        ];
    }
}
