<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile(Request $request)
    {
        // Get the authenticated user using the ParentPal model
        $user = $request->user('parent'); // Specify the guard if using multiple guards

        // If you want to ensure that you only return certain fields, you can do so here:
        return response()->json([
            'status' => 'success',
            'data' => $user // Returns all user data
            // Or return only specific fields: 'data' => $user->only(['name', 'email', 'phone']),
        ]);
    }
}
