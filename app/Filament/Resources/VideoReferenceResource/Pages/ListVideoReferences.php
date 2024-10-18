<?php

namespace App\Filament\Resources\VideoReferenceResource\Pages;

use App\Filament\Resources\VideoReferenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVideoReferences extends ListRecords
{
    protected static string $resource = VideoReferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
