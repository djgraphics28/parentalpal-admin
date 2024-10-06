<?php

namespace App\Filament\Resources\ParentPalResource\Pages;

use App\Filament\Resources\ParentPalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditParentPal extends EditRecord
{
    protected static string $resource = ParentPalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
