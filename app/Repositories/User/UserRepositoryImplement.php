<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Helpers\Global\Constant;
use LaravelEasyRepository\Implementations\Eloquent;

class UserRepositoryImplement extends Eloquent implements UserRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(User $model)
  {
    $this->model = $model;
  }

  public function excludeAdmin()
  {
    return $this->model->excludeAdmin()->orderBy('name', 'ASC');
  }

  public function changeStatus(int $id)
  {
    $user = $this->findOrFail($id);

    if ($user->status == Constant::ACTIVE) :
      $user->updateOrFail([
        'status' => Constant::INACTIVE,
      ]);
    else :
      $user->updateOrFail([
        'status' => Constant::ACTIVE,
      ]);
    endif;

    return $user;
  }

  public function onlyDonor()
  {
    return $this->model->whereHas('roles', function ($query) {
      $query->where('name', Constant::DONOR);
    })->active();
  }
}
