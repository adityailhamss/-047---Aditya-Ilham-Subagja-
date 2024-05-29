<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChartController extends Controller
{
    private $months = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agu', 'sep', 'okt', 'nov', 'des'];

    /**
     * Handle chart statistics request.
     *
     *
     * @return void
     *
     * @author
     */
    public function index(Request $request)
    {
        $query = Borrowing::query();

        $query->when($request->has('year'), function ($q) use ($request) {
            return $q->whereYear('date', $request->year);
        });

        $query->when($request->has('studentID'), function ($q) use ($request) {
            return $q->where('student_id', $request->studentID);
        });

        $results = $query->selectRaw('EXTRACT(MONTH FROM date) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        for ($i = 1; $i <= 12; $i++) {
            // if key exists so there is a borrowing count on that month
            // if key does not exists there is no borrowing on that month so the count
            // should be 0
            $statistics[$this->months[$i - 1]] = isset($results[$i]) ? $results[$i] : 0;
        }

        $commodityQuery = Borrowing::query();

        $commodityQuery->when($request->has('year'), function ($q) use ($request) {
            return $q->whereYear('date', $request->year);
        });

        $commodityQuery->when($request->has('studentID'), function ($q) use ($request) {
            return $q->where('student_id', $request->studentID);
        });

        $commodityCounts = $commodityQuery->join('commodities', 'borrowings.commodity_id', '=', 'commodities.id')
        ->select('commodities.name as commodity_name')
        ->selectRaw('COUNT(borrowings.commodity_id) as count')
        ->groupBy('commodities.name')
        ->orderByDesc('count')
        ->get();

    $commodityData = $commodityCounts->pluck('count', 'commodity_name')->toArray();


        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'ok',
            'data' => $statistics,
            'commodity_data' => $commodityData,
        ], Response::HTTP_OK);
    }
}
