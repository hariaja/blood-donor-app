<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Global\Helper;
use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function __construct(protected UserService $userService)
  {
    # code...
  }

  public function index()
  {
    $user = $this->userService->findOrFail(me()->id);

    $date = $user->donor->birth_date;
    $convertDate = date('Y-m-d', strtotime($date));

    $user->has_avatar = $user->hasAvatar();
    $user->avatar_url = $user->getAvatar();
    $user->birth_date = Helper::customDate($convertDate);
    $user->donor = $user->donor;

    return response()->json([
      'user' => $user,
    ]);
  }
}
