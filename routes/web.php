<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\ChildDailyRoutines;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/children/{childId}/daily-routines', ChildDailyRoutines::class)
    ->name('children.daily-routines');
