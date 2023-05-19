<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\Api\Response;
use App\Traits\UniqueValidation;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
  use UniqueValidation;

  public function __construct(
    protected UserService $userService
  ) {
    // 
  }

  public function store(RegisterRequest $request)
  {
    try {
      $this->userService->registerUsers($request);
      return Response::success('Registrasi Berhasil Dilakukan. Silahkan melakukan login.', false);
    } catch (Exception $e) {
      return Response::error('Error: ' . $e, true, 400);
    }
  }
}
