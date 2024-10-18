<?php

namespace App\Filament\Resources\MilestoneByAgeResource\Pages;

use App\Filament\Resources\MilestoneByAgeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMilestoneByAge extends CreateRecord
{
    protected static string $resource = MilestoneByAgeResource::class;
}
