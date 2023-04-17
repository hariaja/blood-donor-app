<?php

namespace App\Services\User;

use App\Models\Donor;
use App\Models\User;
use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
  public function excludeAdmin();
  public function getBloodTypes();
  public function registerUsers(Request $request);
  public function handleCreateNewUser(Request $request);
  public function updateOfficer(User $user, Request $request);
  public function updateDonor(Donor $donor, Request $request);
  public function handleDeleteUserWithAvatar(User $user);
  public function handleChangeStatus(int $userId);
}
