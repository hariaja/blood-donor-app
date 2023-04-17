<?php

namespace App\Http\Controllers\Settings;

use App\Models\Donor;
use Illuminate\Http\Request;
use App\Helpers\Global\Constant;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\DonorRequest;
use App\Services\BloodType\BloodTypeService;

class DonorController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected RoleService $roleService,
    protected BloodTypeService $bloodTypeService,
  ) {
    // 
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $roles = $this->roleService->onlyDonor()->first();
    $bloodTypes = $this->bloodTypeService->orderByType()->get();
    return view('donors.create', compact('roles', 'bloodTypes'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(DonorRequest $request)
  {
    if ($request->roles === Constant::DONOR) :
      $this->userService->registerUsers($request);
    else :
      abort(500, 'Internal Server Error, Silahkan hubungin admin');
    endif;

    return redirect()->route('users.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Donor $donor)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Donor $donor)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Donor $donor)
  {
    //
  }
}
