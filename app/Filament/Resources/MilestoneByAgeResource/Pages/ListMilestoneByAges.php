<?php

namespace App\Filament\Resources\MilestoneByAgeResource\Pages;

use App\Filament\Resources\MilestoneByAgeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMilestoneByAges extends ListRecords
{
    protected static string $resource = MilestoneByAgeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
