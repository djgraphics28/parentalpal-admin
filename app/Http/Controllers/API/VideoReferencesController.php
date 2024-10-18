<?php

namespace App\Http\Controllers\API;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\VideoReference;
use App\Http\Controllers\Controller;

class VideoReferencesController extends Controller
{
    use HttpResponses;
    public function index()
    {
        $videoReferences = VideoReference::all()->toArray();
        return $this->success($videoReferences, 'Video References retrieved successfully', 200);
    }
}
