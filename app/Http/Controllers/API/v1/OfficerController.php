<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfficerResource;
use App\Models\Officer;
use Symfony\Component\HttpFoundation\Response;

class OfficerController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Officer $officer)
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => new OfficerResource($officer),
        ]);
    }
}
