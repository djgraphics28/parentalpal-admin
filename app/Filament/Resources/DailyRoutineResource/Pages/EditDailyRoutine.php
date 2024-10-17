<?php

namespace App\Filament\Resources\DailyRoutineResource\Pages;

use App\Filament\Resources\DailyRoutineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDailyRoutine extends EditRecord
{
    protected static string $resource = DailyRoutineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
