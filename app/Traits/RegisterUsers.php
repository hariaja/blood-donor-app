<?php

namespace App\Traits;

use App\Models\BloodType;
use App\Services\BloodType\BloodTypeService;
use Illuminate\Foundation\Auth\RedirectsUsers;

trait RegisterUsers
{
  use RedirectsUsers;

  /**
   * Show the application registration form.
   *
   * @return \Illuminate\View\View
   */
  public function showRegistrationForm()
  {
    $bloodTypes = BloodType::orderBy('type', 'ASC')->get();
    return view('auth.register', compact('bloodTypes'));
  }
}
