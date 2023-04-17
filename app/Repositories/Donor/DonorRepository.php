<?php

namespace App\Repositories\Donor;

use LaravelEasyRepository\Repository;

interface DonorRepository extends Repository
{
  public function orderByUserId(int $userId);
}
