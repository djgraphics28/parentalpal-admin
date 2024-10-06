<?php

namespace App\Filament\Resources\MonthRangeResource\Pages;

use App\Filament\Resources\MonthRangeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMonthRange extends EditRecord
{
    protected static string $resource = MonthRangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
