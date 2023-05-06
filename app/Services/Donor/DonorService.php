<?php

namespace App\Services\Donor;

use LaravelEasyRepository\BaseService;

interface DonorService extends BaseService
{
  public function getDonorActive();
  public function getByUserId($userId);
}
