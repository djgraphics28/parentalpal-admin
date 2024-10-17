<?php

namespace App\Http\Controllers\API;

use App\Models\ParentPal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
