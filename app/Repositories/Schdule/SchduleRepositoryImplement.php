<?php

namespace App\Repositories\Schdule;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Schdule;

class SchduleRepositoryImplement extends Eloquent implements SchduleRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Schdule $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
