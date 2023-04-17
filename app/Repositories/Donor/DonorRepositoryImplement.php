<?php

namespace App\Repositories\Donor;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Donor;

class DonorRepositoryImplement extends Eloquent implements DonorRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Donor $model)
  {
    $this->model = $model;
  }

  public function orderByUserId(int $userId)
  {
    return $this->model->where('user_id', $userId);
  }
}
