<?php

namespace App\Services\BloodType;

use LaravelEasyRepository\BaseService;

interface BloodTypeService extends BaseService
{
  public function orderByType();
}
