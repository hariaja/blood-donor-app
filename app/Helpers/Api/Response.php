<?php

namespace App\Helpers\Api;

class Response
{
  public static function success(string $message, string $error = null)
  {
    $error = 'false';
    $message = $message;
    return response()->json([
      'error' => $error,
      'message' => $message
    ], 200);
  }

  public static function error(string $message, string $error = null, int $code = 401)
  {
    $error = 'true';
    $message = $message;
    return response()->json([
      'error' => $error,
      'message' => $message
    ], $code);
  }

  public static function data($data)
  {
    $data = $data;
    return response()->json([
      'data' => $data
    ], 200);
  }
}
