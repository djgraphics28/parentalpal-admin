<?php

namespace App\Http\Controllers\API;

use App\Models\Child;
use App\Models\DailyRoutine;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\ChildrenActivityResource;

class DailyRoutineController extends Controller
{
    use HttpResponses;

    /**
     * @group Daily Routines
     *
     * APIs for managing daily routines for children.
     */

    /**
     * Get all daily routines for a specific child.
     *
     * @bodyParam child_id integer required The ID of the child. Example: 1
     *
     * @param int $child_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($child_id)
    {
        $child = Child::find($child_id);

        if (!$child) {
            return $this->error(null, 'Child not found', 404);
        }

        $routines = $child->dailyRoutines;

        return $this->success(ChildrenActivityResource::collection($routines), 'Daily routines retrieved successfully');
    }

    /**
     * Store a new daily routine for a specific child.
     *
     * @bodyParam child_id integer required The ID of the child. Example: 1
     * @bodyParam routine_title string required The title of the routine. Example: Morning Exercise
     * @bodyParam time_of_day string required The time of day for the routine. Example: Morning
     * @bodyParam date date required The date of the routine. Format: YYYY-MM-DD. Example: 2024-10-01
     *
     * @param Request $request
     * @param int $child_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $child_id)
    {
        $request->validate([
            'activityTitle' => 'required|string|max:255',
            'activityCategory' => 'required|in:Morning,Mid-morning,Mid-day,Afternoon,Evening',
            'activityDateTime' => 'required',
        ]);

        $child = Child::find($child_id);

        if (!$child) {
            return $this->error(null, 'Child not found', 404);
        }

        $routine = DailyRoutine::create([
            'child_id' => $child_id,
            'routine_title' => $request->activityTitle,
            'time_of_day' => $request->activityCategory,
            'date' => $request->activityDateTime,
        ]);

        return $this->success($routine, 'Daily routine added successfully', 201);
    }

    /**
     * Show a specific routine for a child.
     *
     * @bodyParam child_id integer required The ID of the child. Example: 1
     * @bodyParam routine_id integer required The ID of the routine. Example: 1
     *
     * @param int $child_id
     * @param int $routine_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($child_id, $routine_id)
    {
        $routine = DailyRoutine::where('child_id', $child_id)->find($routine_id);

        if (!$routine) {
            return $this->error(null, 'Daily routine not found', 404);
        }

        return $this->success($routine, 'Daily routine retrieved successfully');
    }

    /**
     * Update a daily routine for a specific child.
     *
     * @bodyParam child_id integer required The ID of the child. Example: 1
     * @bodyParam routine_id integer required The ID of the routine. Example: 1
     * @bodyParam routine_title string required The updated title of the routine. Example: Updated Morning Exercise
     * @bodyParam time_of_day string required The updated time of day for the routine. Example: Mid-Day
     * @bodyParam date date required The updated date of the routine. Format: YYYY-MM-DD. Example: 2024-10-01
     *
     * @param Request $request
     * @param int $child_id
     * @param int $routine_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $child_id, $routine_id)
    {
        $routine = DailyRoutine::where('child_id', $child_id)->find($routine_id);

        if (!$routine) {
            return $this->error(null, 'Daily routine not found', 404);
        }

        $request->validate([
            'routine_title' => 'required|string|max:255',
            'time_of_day' => 'required|in:Morning,Mid-Morning,Mid-Day,Afternoon,Evening',
            'date' => 'required|date',
        ]);

        $routine->update($request->only(['routine_title', 'time_of_day', 'date']));

        return $this->success($routine, 'Daily routine updated successfully');
    }

    /**
     * Delete a daily routine for a specific child.
     *
     * @bodyParam child_id integer required The ID of the child. Example: 1
     * @bodyParam routine_id integer required The ID of the routine. Example: 1
     *
     * @param int $child_id
     * @param int $routine_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($child_id, $routine_id)
    {
        $routine = DailyRoutine::where('child_id', $child_id)->find($routine_id);

        if (!$routine) {
            return $this->error(null, 'Daily routine not found', 404);
        }

        $routine->delete();

        return $this->success([], 'Daily routine deleted successfully');
    }
}
