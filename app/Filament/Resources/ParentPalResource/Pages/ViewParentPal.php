<?php

namespace App\Filament\Resources\ParentPalResource\Pages;

use App\Filament\Resources\ParentPalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewParentPal extends ViewRecord
{
    protected static string $resource = ParentPalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
