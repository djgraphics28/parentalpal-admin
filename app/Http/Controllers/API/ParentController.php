<?php

namespace App\Http\Controllers\API;

use App\Models\ParentPal;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    use HttpResponses;

    /**
     * @group Parents
     *
     * APIs for managing parents.
     */

    /**
     * Get all users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $parents = ParentPal::all()->toArray();
        return $this->success($parents, 'Parents retrieved successfully');
    }

    /**
     * Get a specific parent by ID.
     *
     * @bodyParam id integer required The ID of the parent. Example: 1
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $parent = ParentPal::find($id);

        if (!$parent) {
            return $this->error(null, 'User not found', 404);
        }

        return $this->success($parent, 'Parent retrieved successfully');
    }

    /**
     * Update a user's profile (name, email, etc.).
     *
     * @bodyParam id integer required The ID of the user. Example: 1
     * @bodyParam name string optional The parent's name. Example: John Doe
     * @bodyParam email string optional The parent's email. Example: john@example.com
     * @bodyParam password string optional The parent's password. Must be at least 8 characters. Confirm password with 'password_confirmation'.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = ParentPal::find($id);

        if (!$user) {
            return $this->error(null, 'Parent not found', 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:parent_pals,email,' . $id,
            'password' => ['sometimes', 'confirmed', Password::min(8)],
        ]);

        // Update the user
        $user->update($request->only(['name', 'email', 'password']));

        // If password is being updated, hash it
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return $this->success($user, 'Parent updated successfully');
    }

    /**
     * Delete a user.
     *
     * @bodyParam id integer required The ID of the user. Example: 1
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $parent = ParentPal::find($id);

        if (!$parent) {
            return $this->error(null, 'Parent not found', 404);
        }

        $parent->delete();

        return $this->success([], 'Parent deleted successfully');
    }
}
