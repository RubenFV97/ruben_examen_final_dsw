<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DesaTrainer;
use App\Models\Instruction;
use App\Models\Scenario;
use Exception;
use Illuminate\Http\JsonResponse;

class DesaTrainerApiController extends Controller
{
    public function index()
    {
        try {
            $instructions = Instruction::all();
            $desas = DesaTrainer::all();
            $scenarios = Scenario::all();

            return response()->json([
                'Desas' => $desas,
                'scenarios' => $scenarios,
                'instructions' => $instructions,
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
            $desa = DesaTrainer::find($id);
        
            if (!$desa) {
                return response()->json([
                    'data' => null,
                    'message' => 'Scenario not found'
                ], JsonResponse::HTTP_NOT_FOUND);
            }
        
            return response()->json([
                'data' => $desa,
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
