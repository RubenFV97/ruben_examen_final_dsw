<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Scenario;
use Exception;
use Illuminate\Http\JsonResponse;

class ScenarioApiController extends Controller
{
    public function index()
    {
        try {
            $scenarios = Scenario::all();

            return response()->json([
                'data' => $scenarios,
                'message' => 'Succeed'
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $scenario = Scenario::find($id);
        
            if (!$scenario) {
                return response()->json([
                    'data' => null,
                    'message' => 'Scenario not found'
                ], JsonResponse::HTTP_NOT_FOUND);
            }
        
            return response()->json([
                'data' => $scenario,
                'message' => 'Succeed'
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
