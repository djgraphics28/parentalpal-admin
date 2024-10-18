<?php

namespace App\Http\Controllers\API;

use App\Models\MilestoneByAge;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;

class MilestonesByAgeController extends Controller
{
    use HttpResponses;
    public function index()
    {
        $milestones = MilestoneByAge::all()->toArray();
        return $this->success($milestones, 'Milestones by Age retrieved successfully', 200);
    }
}
