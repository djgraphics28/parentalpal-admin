<?php

namespace App\Http\Controllers\API;

use App\Models\Milestone;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;

class MilestoneController extends Controller
{
    use HttpResponses;

    /**
     * @group Milestones
     *
     * APIs for managing milestones.
     */

    /**
     * Get a list of milestones.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Fetch milestones from the database
        $milestones = Milestone::all()->toArray();

        // Use your response trait to return the data
        return $this->success($milestones, 'Milestones retrieved successfully.', 200);
    }

    /**
     * Store a new milestone.
     *
     * @bodyParam name string required The name of the milestone. Example: Milestone 1
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Add other validation rules as needed
        ]);

        // Create a new milestone
        $milestone = Milestone::create($validatedData);

        // Return success response using the trait
        return $this->success($milestone, 'Milestone created successfully.', 201);
    }

    /**
     * Show a specific milestone.
     *
     * @bodyParam id integer required The ID of the milestone. Example: 1
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $milestone = Milestone::find($id);

        if (!$milestone) {
            return $this->error(null, 'Milestone not found.', 404);
        }

        return $this->success($milestone, 'Milestone retrieved successfully.');
    }

    /**
     * Update a milestone.
     *
     * @bodyParam id integer required The ID of the milestone. Example: 1
     * @bodyParam name string required The updated name of the milestone. Example: Updated Milestone 1
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $milestone = Milestone::find($id);

        if (!$milestone) {
            return $this->error(null, 'Milestone not found.', 404);
        }

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            // Add other validation rules as needed
        ]);

        // Update the milestone
        $milestone->update($validatedData);

        return $this->success($milestone, 'Milestone updated successfully.');
    }

    /**
     * Delete a milestone.
     *
     * @bodyParam id integer required The ID of the milestone. Example: 1
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $milestone = Milestone::find($id);

        if (!$milestone) {
            return $this->error(null, 'Milestone not found.', 404);
        }

        $milestone->delete();

        return $this->success([], 'Milestone deleted successfully.');
    }
}
