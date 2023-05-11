<?php

namespace App\Services\Schedule;

use LaravelEasyRepository\BaseService;

interface ScheduleService extends BaseService
{
  public function createWithSendNotification($request);
  public function updateWithSendNotification($schedule, $request);
}
