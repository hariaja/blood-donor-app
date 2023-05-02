<?php

namespace App\Services\Registration;

use LaravelEasyRepository\BaseService;

interface RegistrationService extends BaseService
{
  public function getByUserId();
  public function getApprovedOnly();
  public function handleNewRegistration($request);
  public function handleUpdateStatus($registration, $request);
}
