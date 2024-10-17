<?php

namespace App\Filament\Resources\ParentPalResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\DailyRoutine;
use Illuminate\Support\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ChildrenRelationManager extends RelationManager
{
    protected static string $relationship = 'children';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->collection('avatars'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                // Birthdate
                Forms\Components\DatePicker::make('birth_date')
                    ->native(false)
                    ->required(),
                // Gender
                Forms\Components\Select::make('gender')
                    ->required()
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->collection('avatars'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('birth_date')
                    ->label('Birth Date'),

                // Calculate and display age in total months as a whole number
                Tables\Columns\TextColumn::make('age')
                    ->label('Age')
                    ->getStateUsing(function ($record) {
                        $birthDate = Carbon::parse($record->birth_date);
                        $now = Carbon::now();

                        // Calculate the total age in months (always a whole number)
                        $totalMonths = $birthDate->diffInMonths($now);

                        // Format the total months using number_format
                        return number_format($totalMonths) . ' month' . ($totalMonths === 1 ? '' : 's');
                    }),
            ])
            ->filters([
                // Add any filters if needed
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('View Daily Routines')
                    ->url(fn($record) => route('children.daily-routines', ['childId' => $record->id]))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('Enter DailyRoutine')
                    ->modal()
                    ->modalWidth('lg') // Set modal width
                    ->form($this->dailyRoutineForm()) // Bind the form for daily routine
                    ->action(function ($record, array $data) {
                        // Create the DailyRoutine entry
                        DailyRoutine::create([
                            'child_id' => $record->id,
                            'routine_title' => $data['routine_title'],
                            'time_of_day' => $data['time_of_day'],
                            'date' => $data['date'],
                        ]);

                        // Show a success notification
                        Notification::make()
                            ->title('Success')
                            ->body('Daily routine added successfully!')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('Create Milestone') // New Action
                    ->action(function ($record) {
                        // Define the action logic here, e.g., navigate to Milestone creation form
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected function dailyRoutineForm(): array
    {
        return [
            Forms\Components\TextInput::make('routine_title')
                ->required()
                ->label('Routine Title')
                ->maxLength(255),

            Forms\Components\Select::make('time_of_day')
                ->required()
                ->label('Time of Day')
                ->options([
                    'Morning' => 'Morning',
                    'Mid-morning' => 'Mid-morning',
                    'Mid-day' => 'Mid-day',
                    'Afternoon' => 'Afternoon',
                    'Evening' => 'Evening',
                ]),

            Forms\Components\DatePicker::make('date')
                ->required()
                ->label('Date')
                ->native(false),
        ];
    }
}
