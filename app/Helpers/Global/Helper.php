<?php

namespace App\Helpers\Global;

use Illuminate\Support\Carbon;

class Helper
{
  public static function convertToAge(string $value)
  {
    $currentDate = Carbon::now()->format('Y-m-d');
    $brithDate = Carbon::parse($value);
    $age = $brithDate->diffInYears($currentDate);
    return $age;
  }
}
