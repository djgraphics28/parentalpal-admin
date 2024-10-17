<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyRoutineResource\Pages;
use App\Filament\Resources\DailyRoutineResource\RelationManagers;
use App\Models\DailyRoutine;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DailyRoutineResource extends Resource
{
    protected static ?string $model = DailyRoutine::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('child_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('routine_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('time_of_day')
                    ->required(),
                Forms\Components\DateTimePicker::make('date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('child_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('routine_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('time_of_day'),
                Tables\Columns\TextColumn::make('date')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListDailyRoutines::route('/'),
            'create' => Pages\CreateDailyRoutine::route('/create'),
            'edit' => Pages\EditDailyRoutine::route('/{record}/edit'),
        ];
    }
}
