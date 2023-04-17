<?php

namespace App\Repositories\BloodType;

use App\Models\BloodType;
use LaravelEasyRepository\Implementations\Eloquent;

class BloodTypeRepositoryImplement extends Eloquent implements BloodTypeRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(BloodType $model)
  {
    $this->model = $model;
  }

  // Order By Name
  public function orderByType()
  {
    return $this->model->orderBy('type', 'ASC');
  }
}
