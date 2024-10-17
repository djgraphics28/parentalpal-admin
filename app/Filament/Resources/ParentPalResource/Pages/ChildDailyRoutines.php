<?php

namespace App\Filament\Pages;

use App\Models\DailyRoutine;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\EnumColumn;
use Illuminate\Database\Eloquent\Builder;

class ChildDailyRoutines extends Page
{
    protected static string $resource = 'App\Filament\Resources\ChildResource'; // Reference your child resource
    protected static string $view = 'filament.resources.parent-pal-resource.pages.child-daily-routines';

    public function mount($childId)
    {
        $this->childId = $childId; // Store the child ID for querying routines
    }

    public function getChildDailyRoutinesProperty()
    {
        return DailyRoutine::where('child_id', $this->childId)->get();
    }

    public function getTitle(): string
    {
        return 'Daily Routines for Child'; // Set the title for the page
    }
}
