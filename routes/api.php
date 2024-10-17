<?php

use App\Http\Controllers\API\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ChildController;
use App\Http\Controllers\API\ParentController;
use App\Http\Controllers\API\MilestoneController;
use App\Http\Controllers\API\MonthRangeController;
use App\Http\Controllers\API\DailyRoutineController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//public routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);

//protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);

    Route::get('/{userId}/profile', [ProfileController::class, 'getProfile'])->name('api.profile');

    Route::get('/{parentId}/children', [ChildController::class, 'index']);         // Get all children for the authenticated user
    Route::post('/{parentId}/children', [ChildController::class, 'store']);        // Create a new child
    Route::get('/children/{id}', [ChildController::class, 'show']);     // Get a specific child
    Route::put('/children/{id}', [ChildController::class, 'update']);   // Update a child's information
    Route::delete('/children/{id}', [ChildController::class, 'destroy']);// Delete a child

    // Route::apiResource('children', ChildController::class);
    Route::apiResource('parents', ParentController::class);
    Route::apiResource('month-ranges', MonthRangeController::class);
    Route::apiResource('milestones', MilestoneController::class);

    Route::get('children/{child_id}/daily-routines', [DailyRoutineController::class, 'index']);          // Get all daily routines for a child
    Route::post('children/{child_id}/daily-routines', [DailyRoutineController::class, 'store']);         // Create a new daily routine
    Route::get('children/{child_id}/daily-routines/{routine_id}', [DailyRoutineController::class, 'show']); // Get a specific routine
    Route::put('children/{child_id}/daily-routines/{routine_id}', [DailyRoutineController::class, 'update']); // Update a routine
    Route::delete('children/{child_id}/daily-routines/{routine_id}', [DailyRoutineController::class, 'destroy']); // Delete a routine

    // Route::get('month-ranges', [MonthRangeController::class, 'index']);          // Get all month ranges
    // Route::post('month-ranges', [MonthRangeController::class, 'store']);         // Create a month range
    // Route::get('month-ranges/{id}', [MonthRangeController::class, 'show']);      // Get a specific month range
    // Route::put('month-ranges/{id}', [MonthRangeController::class, 'update']);    // Update a month range
    // Route::delete('month-ranges/{id}', [MonthRangeController::class, 'destroy']); // Delete a month range

    // Route::get('/milestones', [MilestoneController::class, 'index']); // Retrieve all milestones
    // Route::post('/milestones', [MilestoneController::class, 'store']); // Create a new milestone
    // Route::get('/milestones/{id}', [MilestoneController::class, 'show']); // Retrieve a specific milestone
    // Route::put('/milestones/{id}', [MilestoneController::class, 'update']); // Update a specific milestone
    // Route::delete('/milestones/{id}', [MilestoneController::class, 'destroy']); // Delete a specific milestone
});
