<?php

namespace App\Http\Controllers\Api\Masters;

use App\Helpers\Api\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\RegistrationRequest;
use App\Services\Registration\RegistrationService;
use Exception;

class RegistrationController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected RegistrationService $registrationService,
  ) {
    // 
  }

  public function index()
  {
    try {
      $result = $this->registrationService->getByUserId()->filter(request(['search']))->paginate(5);
      return response()->json($result);
    } catch (Exception $e) {
      return Response::error('Error:' . $e, true, 400);
    }
  }

  public function store(RegistrationRequest $request)
  {
    try {
      $this->registrationService->handleNewRegistration($request);
      return Response::success(trans('session.create'), false);
    } catch (Exception $e) {
      return Response::error('Error:' . $e, true, 400);
    }
  }
}
