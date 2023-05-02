<?php

namespace App\Services\Schdule;

use LaravelEasyRepository\Service;
use App\Repositories\Schdule\SchduleRepository;

class SchduleServiceImplement extends Service implements SchduleService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(SchduleRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
