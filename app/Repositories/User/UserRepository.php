<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
  public function excludeAdmin();
  public function onlyDonor();
  public function changeStatus(int $id);
}
