<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\Api\Response;
use App\Http\Controllers\Controller;
use App\Services\BloodType\BloodTypeService;

class BloodTypeController extends Controller
{
  public function __construct(
    protected BloodTypeService $bloodTypeService
  ) {
    // 
  }

  public function index()
  {
    try {
      $response = $this->bloodTypeService->orderByType()->get();
      return response()->json([
        'data' => $response,
      ]);
    } catch (Exception $e) {
      return Response::error('Error: ' . $e, true, 400);
    }
  }
}
