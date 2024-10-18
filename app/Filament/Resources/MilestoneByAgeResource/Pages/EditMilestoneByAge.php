<?php

namespace App\Filament\Resources\MilestoneByAgeResource\Pages;

use App\Filament\Resources\MilestoneByAgeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMilestoneByAge extends EditRecord
{
    protected static string $resource = MilestoneByAgeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
