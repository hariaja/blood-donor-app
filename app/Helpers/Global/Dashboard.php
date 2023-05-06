<?php

namespace App\Helpers\Global;

use App\Models\User;
use App\Models\Registration;
use App\Models\Schedule;

class Dashboard
{
  public function userDonorActive()
  {
    return User::whereHas('roles', fn ($query) => $query->where('name', Constant::DONOR))->active()->count();
  }

  public function registrationApproved()
  {
    return Registration::approved()->count();
  }

  public function hasArrivedSchedule()
  {
    return Schedule::hasArrived()->count();
  }
}
