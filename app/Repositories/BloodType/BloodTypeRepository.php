<?php

namespace App\Repositories\BloodType;

use LaravelEasyRepository\Repository;

interface BloodTypeRepository extends Repository
{
  public function orderByType();
}
