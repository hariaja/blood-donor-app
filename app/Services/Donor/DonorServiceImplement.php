<?php

namespace App\Services\Donor;

use LaravelEasyRepository\Service;
use App\Repositories\Donor\DonorRepository;

class DonorServiceImplement extends Service implements DonorService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(DonorRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
