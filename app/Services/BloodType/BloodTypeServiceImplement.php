<?php

namespace App\Services\BloodType;

use LaravelEasyRepository\Service;
use App\Repositories\BloodType\BloodTypeRepository;

class BloodTypeServiceImplement extends Service implements BloodTypeService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(BloodTypeRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  // Order by type.
  public function orderByType()
  {
    return $this->mainRepository->orderByType();
  }
}
