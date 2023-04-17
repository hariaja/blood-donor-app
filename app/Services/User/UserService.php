<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
  public function excludeAdmin();
  public function getBloodTypes();
  public function registerUsers(Request $request);
  public function handleCreateNewUser(Request $request);
}
