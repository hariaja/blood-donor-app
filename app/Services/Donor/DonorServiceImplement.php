<?php

namespace App\Services\Donor;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\Donor\DonorRepository;

class DonorServiceImplement extends Service implements DonorService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(DonorRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function getDonorActive()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->getDonorActive();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function getByUserId($userId)
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->orderByUserId($userId);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('state.log.error'));
    }
    DB::commit();
    return $return;
  }
}
