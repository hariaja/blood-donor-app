<?php

namespace App\Services\Role;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface RoleService extends BaseService
{
  public function whereNotInAdmin();
  public function onlyOfficer();
  public function onlyDonor();
  public function firstOrCreate(Request $request);
  public function updateOrFail(int $id, Request $request);
  public function roleHasPermissions(int $id);
}
