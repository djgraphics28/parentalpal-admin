<?php

namespace App\Filament\Resources\MonthRangeResource\Pages;

use App\Filament\Resources\MonthRangeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonthRanges extends ListRecords
{
    protected static string $resource = MonthRangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
