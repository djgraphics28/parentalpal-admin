<?php

namespace App\Filament\Resources\DailyRoutineResource\Pages;

use App\Filament\Resources\DailyRoutineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDailyRoutines extends ListRecords
{
    protected static string $resource = DailyRoutineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
