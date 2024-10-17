<?php

namespace App\Http\Controllers\API;

use App\Models\ParentPal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
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
            'data' => New ProfileResource($user) // Returns all user data
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

    public function uploadProfilePicture(Request $request, $id)
    {
        // Get the authenticated user or find by ID
        $user = ParentPal::find($id);

        // Validate the incoming request
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Adjust rules as necessary
        ]);

        // Handle file upload using Media Library
        if ($request->hasFile('profile_picture')) {
            // Clear the existing media in the avatars collection if necessary
            if ($user->hasMedia('avatars')) {
                $user->clearMediaCollection('avatars');
            }

            // Add the new profile picture to the avatars collection
            $user->addMedia($request->file('profile_picture'))->toMediaCollection('avatars');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Profile picture updated successfully',
            'data' => [
                'profilePicture' => $user->getFirstMediaUrl('avatars'), // Get the URL of the uploaded image
            ]
        ]);
    }


}
