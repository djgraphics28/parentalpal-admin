<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    use HttpResponses;

    /**
     * @group Children
     *
     * APIs for managing children's information for authenticated parents.
     */

    /**
     * Create a child for a user.
     *
     * @bodyParam name string required The name of the child. Example: John Doe
     * @bodyParam birth_date date required The birth date of the child. Format: YYYY-MM-DD. Example: 2020-01-01
     * @bodyParam gender string required The gender of the child. Example: Male
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Male,Female',
        ]);

        $child = Child::create([
            'user_id' => Auth::id(),  // Use the authenticated parent's ID
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
        ]);

        return $this->success($child, 'Child added successfully', 201);
    }

    /**
     * Get all children for the authenticated parent.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $children = Auth::user()->children;  // Assuming User has a children relationship

        return $this->success($children, 'Children retrieved successfully');
    }

    /**
     * Get a specific child.
     *
     * @bodyParam id integer required The ID of the child. Example: 1
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $child = Auth::user()->children()->find($id);

        if (!$child) {
            return $this->error(null, 'Child not found', 404);
        }

        return $this->success($child, 'Child retrieved successfully', 200);
    }

    /**
     * Update a child's information.
     *
     * @bodyParam id integer required The ID of the child. Example: 1
     * @bodyParam name string optional The updated name of the child. Example: Jane Doe
     * @bodyParam birth_date date optional The updated birth date of the child. Format: YYYY-MM-DD. Example: 2021-01-01
     * @bodyParam gender string optional The updated gender of the child. Example: Female
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $child = Auth::user()->children()->find($id);

        if (!$child) {
            return $this->error(null, 'Child not found', 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'birth_date' => 'sometimes|date',
            'gender' => 'sometimes|in:Male,Female',
        ]);

        $child->update($request->only(['name', 'birth_date', 'gender']));

        return $this->success($child, 'Child updated successfully');
    }

    /**
     * Delete a child.
     *
     * @bodyParam id integer required The ID of the child. Example: 1
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $child = Auth::user()->children()->find($id);

        if (!$child) {
            return $this->error(null, 'Child not found', 404);
        }

        $child->delete();

        return $this->success([], 'Child deleted successfully');
    }
}
