<?php

namespace App\Http\Controllers\Api\Auth;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Helpers\Api\Response;
use App\Helpers\Global\Helper;
use App\Helpers\Global\Constant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client as OClient;

class LoginController extends Controller
{
  public function refresh(Request $request)
  {
    $request->validate([
      'refresh_token' => 'required'
    ]);

    $oClient = OClient::where('password_client', 1)->first();
    return $this->getRefreshedToken($oClient, request('refresh_token'));
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|string',
      'password' => 'required|string',
    ]);

    $credentials = request(['email', 'password']);

    if (!Auth::attempt($credentials)) {
      return Response::error(trans('session.api.invalid'), true);
    }

    $user = $request->user();

    if ($user->status == Constant::INACTIVE) {
      return Response::error(trans('session.api.inactive'), true, 400);
    }

    if ($user->isRoleName() !== Constant::DONOR) {
      return Response::error(trans('session.api.not_donor'), true, 400);
    }

    $oClient = OClient::where('password_client', 1)->first();
    $tokens = $this->getTokens($oClient, request('email'), request('password'));

    $date = $user->donor->birth_date;
    $convertDate = date('Y-m-d', strtotime($date));

    $user->has_avatar = $user->hasAvatar();
    $user->avatar_url = $user->getAvatar();
    $user->birth_date = Helper::customDate($convertDate);
    $user->donor = $user->donor;

    $user->access_token = $tokens->getData()->access_token;
    $user->refresh_token = $tokens->getData()->refresh_token;

    return response()->json([
      'user' => $user,
    ], 200);
  }

  public function logout(Request $request)
  {
    $request->user()->token()->revoke();
    return response()->json([
      'message' => trans('session.api.logout'),
    ], 200);
  }

  protected function getTokens(OClient $oClient, $email, $password)
  {
    $oClient = OClient::where('password_client', 1)->first();
    $http = new Client;

    $response = $http->request('POST', url('/') . '/oauth/token', [
      'form_params' => [
        'grant_type' => 'password',
        'client_id' => $oClient->id,
        'client_secret' => $oClient->secret,
        'username' => $email,
        'password' => $password,
        'scope' => '*',
      ],
    ]);

    $result = json_decode((string) $response->getBody(), true);
    return response()->json($result, 200);
  }

  protected function getRefreshedToken(OClient $oClient, $refresh_token)
  {
    $oClient = OClient::where('password_client', 1)->first();
    $http = new Client;

    $response = $http->request('POST', url('/') . '/oauth/token', [
      'form_params' => [
        'grant_type' => 'refresh_token',
        'refresh_token' => $refresh_token,
        'client_id' => $oClient->id,
        'client_secret' => $oClient->secret,
        'scope' => '*',
      ],
    ]);

    $result = json_decode((string) $response->getBody(), true);
    return response()->json($result, 200);
  }
}
