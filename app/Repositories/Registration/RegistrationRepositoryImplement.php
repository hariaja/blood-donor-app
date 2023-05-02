<?php

namespace App\Repositories\Registration;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Registration;

class RegistrationRepositoryImplement extends Eloquent implements RegistrationRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Registration $model)
  {
    $this->model = $model;
  }

  public function approvedRegistration()
  {
    return $this->model->approved();
  }

  public function getByUserId()
  {
    return $this->model->where('user_id', me()->id);
  }
}
