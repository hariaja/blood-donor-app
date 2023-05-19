<?php

namespace App\Traits;

use Exception;
use App\Models\User;
use App\Models\Donor;
use Illuminate\Http\Request;
use App\Helpers\Api\Response;

trait UniqueValidation
{
  public function checkNik(Request $request)
  {
    $request->validate([
      'nik' => 'required',
    ]);

    try {
      $check = Donor::where('nik', $request->nik)->first();

      if ($check) {
        return response()->json([
          'is_nik_exist' => true,
        ]);
      } else {
        return response()->json([
          'is_nik_exist' => false,
        ]);
      }
    } catch (Exception $e) {
      return Response::error('Error: ' . $e, true, 400);
    }
  }

  public function checkEmail(Request $request)
  {
    $request->validate([
      'email' => 'required',
    ]);

    try {
      // Check if email is available
      $check = User::where('email', $request->email)->first();

      if ($check) {
        return response()->json([
          'is_email_exist' => true,
        ]);
      } else {
        return response()->json([
          'is_email_exist' => false,
        ]);
      }
    } catch (Exception $e) {
      return Response::error('Error : ' . $e, true, 400);
    }
  }

  public function checkPhone(Request $request)
  {
    $request->validate([
      'phone' => 'required',
    ]);

    try {
      $check = User::where('phone', $request->phone)->first();

      if ($check) {
        return response()->json([
          'is_phone_exist' => true,
        ]);
      } else {
        return response()->json([
          'is_phone_exist' => false,
        ]);
      }
    } catch (Exception $e) {
      return Response::error('Error: ' . $e, true, 400);
    }
  }
}
