<?php

namespace App\Services\Schedule;

use Exception;
use InvalidArgumentException;
use App\Helpers\Global\Helper;
use Illuminate\Support\Carbon;
use App\Helpers\Global\Constant;
use App\Helpers\Global\SendMail;
use App\Mail\Schedules\ChangeScheduleMail;
use App\Mail\Schedules\InvitationMail;
use App\Repositories\Registration\RegistrationRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LaravelEasyRepository\Service;
use App\Repositories\Schedule\ScheduleRepository;
use Illuminate\Support\Facades\Mail;

class ScheduleServiceImplement extends Service implements ScheduleService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $registrationRepository;

  public function __construct(
    ScheduleRepository $mainRepository,
    RegistrationRepository $registrationRepository,
  ) {
    $this->mainRepository = $mainRepository;
    $this->registrationRepository = $registrationRepository;
  }

  public function createWithSendNotification($request)
  {
    DB::beginTransaction();
    try {

      $registration = $this->registrationRepository->findOrFail($request->registration_id);

      SendMail::sendInvitationMail($registration, $request);

      $return = $this->mainRepository->create($request->validated());
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function updateWithSendNotification($schedule, $request)
  {
    DB::beginTransaction();
    try {

      if ($request->status !== Constant::NOT_YET_COME) :
      // 
      else :
        SendMail::sendChangeInvitationMail($schedule, $request);
      endif;

      $return = $this->mainRepository->update($schedule->id, $request->validated());
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $return;
  }
}
