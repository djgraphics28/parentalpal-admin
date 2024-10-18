<?php

namespace App\Filament\Resources\VideoReferenceResource\Pages;

use App\Filament\Resources\VideoReferenceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVideoReference extends EditRecord
{
    protected static string $resource = VideoReferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
