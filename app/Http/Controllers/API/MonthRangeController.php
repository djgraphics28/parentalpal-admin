<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MonthRange;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class MonthRangeController extends Controller
{
    use HttpResponses;

    /**
     * @group Month Ranges
     *
     * APIs for managing month ranges.
     */

    /**
     * Get all month ranges.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $monthRanges = MonthRange::all()->toArray();
        return $this->success($monthRanges, 'Month Ranges retrieved successfully');
    }

    /**
     * Create a new month range.
     *
     * @bodyParam month_start string required The start month of the range. Example: January
     * @bodyParam month_end string required The end month of the range. Example: December
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'month_range' => 'required|string',
        ]);

        $monthRange = MonthRange::create([
            'month_range' => $request->month_range
        ]);

        return $this->success($monthRange, 'Month Range created successfully');
    }

    /**
     * Get a specific month range.
     *
     * @bodyParam id integer required The ID of the month range. Example: 1
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $monthRange = MonthRange::find($id);

        if (!$monthRange) {
            return $this->error(null, 'Month Range not found', 404);
        }

        return $this->success($monthRange, 'Month Range retrieved successfully');
    }

    /**
     * Update a month range.
     *
     * @bodyParam id integer required The ID of the month range. Example: 1
     * @bodyParam month_start string required The updated start month of the range. Example: January
     * @bodyParam month_end string required The updated end month of the range. Example: December
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $monthRange = MonthRange::find($id);

        if (!$monthRange) {
            return $this->error(null, 'Month Range not found', 404);
        }

        $request->validate([
            'month_range' => 'sometimes|required|string',
        ]);

        $monthRange->update($request->only(['month_range']));

        return $this->success($monthRange, 'Month Range updated successfully');
    }

    /**
     * Delete a month range.
     *
     * @bodyParam id integer required The ID of the month range. Example: 1
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $monthRange = MonthRange::find($id);

        if (!$monthRange) {
            return $this->error(null, 'Month Range not found', 404);
        }

        $monthRange->delete();

        return $this->success([], 'Month Range deleted successfully');
    }
}
