<?php

namespace App\Http\Controllers\API;

use App\Models\ParentPal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Livewire\Features\SupportConsoleCommands\Commands\Upgrade\ChangeTestAssertionMethods;

class ProfileController extends Controller
{
    public function getProfile(Request $request, $id)
    {
        // Get the authenticated user using the ParentPal model
        $user = ParentPal::find($id);

        // If you want to ensure that you only return certain fields, you can do so here:
        return response()->json([
            'status' => 'success',
            'data' => $user // Returns all user data
            // Or return only specific fields: 'data' => $user->only(['name', 'email', 'phone']),
        ]);
    }

    public function updateProfile(Request $request, $id)
    {
        // Get the authenticated user using the ParentPal model
        $user = ParentPal::find($id);

        // Update the user's profile with the request data
        $user->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'data' => $user
        ]);
    }

    //updatePassword
    public function updatePassword(Request $request, $id)
    {
        // Get the authenticated user using the ParentPal model
        $user = ParentPal::find($id);


        // Check if the current password matches
        if (!password_verify($request->currentPassword, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Current password is incorrect'
            ], 401);
        }

        // Update the user's password
        $user->update([
            'password' => bcrypt($request->newPassword)
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully'
        ]);
    }

}
