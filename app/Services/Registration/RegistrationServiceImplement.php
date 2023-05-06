<?php

namespace App\Services\Registration;

use Exception;
use InvalidArgumentException;
use App\Helpers\Global\Helper;
use Illuminate\Support\Carbon;
use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\Registration\RegistrationRepository;

class RegistrationServiceImplement extends Service implements RegistrationService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(RegistrationRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function getApprovedOnly()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->approvedRegistration();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function getByUserId()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->getByUserId();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function registrationHasSchedule()
  {
    // 
  }

  public function handleNewRegistration($request)
  {
    DB::beginTransaction();
    try {

      // Create number
      $request['number'] = Helper::auto('registrations', 'number', 'RG' . date('Ym'), 9, 3);
      $request['user_id'] = me()->id;

      // Get month
      if ($request->last_donor) :
        $last_donor = $request->last_donor;
        $return_donor = Carbon::createFromFormat('Y-m-d', $last_donor, 'Asia/Jakarta')->addMonths(2);
        $request['return_donor'] = $return_donor->format('Y-m-d');
      else :
        $request['return_donor'] = null;
      endif;

      $return = $this->mainRepository->create($request->all());
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function handleUpdateStatus($registration, $request)
  {
    DB::beginTransaction();
    try {

      // Get month
      if ($request->status === Constant::APPROVED) :
        if ($registration->last_donor) :
          $request['last_donor'] = $registration->last_donor;
          $request['return_donor'] = $registration->return_donor;
        else :
          $last_donor = now()->format('Y-m-d');
          $return_donor = Carbon::createFromFormat('Y-m-d', $last_donor, 'Asia/Jakarta')->addMonths(2);
          $request['last_donor'] = $last_donor;
          $request['return_donor'] = $return_donor->format('Y-m-d');
        endif;
      else :
        $request['last_donor'] = null;
        $request['return_donor'] = null;
      endif;

      $return = $this->mainRepository->update($registration->id, $request->all());
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $return;
  }
}
