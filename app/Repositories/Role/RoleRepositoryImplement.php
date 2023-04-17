<?php

namespace App\Repositories\Role;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Helpers\Global\Constant;
use LaravelEasyRepository\Implementations\Eloquent;

class RoleRepositoryImplement extends Eloquent implements RoleRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Role $model)
  {
    $this->model = $model;
  }

  public function whereNotInAdmin()
  {
    return $this->model->select('*')->whereNotIn('name', [
      Constant::ADMIN,
    ])->orderBy('name', 'ASC');
  }

  public function onlyOfficer()
  {
    return $this->model->select('*')->where('name', Constant::OFFICER);
  }

  public function onlyDonor()
  {
    return $this->model->select('*')->where('name', Constant::DONOR);
  }

  public function firstOrCreate(Request $request)
  {
    $this->model->firstOrCreate([
      'name' => $request->name,
    ])->syncPermissions($request->permission);
  }

  public function updateOrFail(int $id, Request $request)
  {
    $role = $this->findOrFail($id);
    $role->updateOrFail([
      'name' => $request->name,
    ]);
    return $role->syncPermissions($request->permission);
  }

  public function roleHasPermissions(int $id)
  {
    $role = $this->findOrFail($id);
    return $role->permissions->pluck('name')->toArray();
  }
}
