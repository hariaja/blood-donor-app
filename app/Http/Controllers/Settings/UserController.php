<?php

namespace App\Http\Controllers\Settings;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\DataTables\Scopes\RolesFilter;
use App\DataTables\Scopes\StatusFilter;
use App\DataTables\Settings\UserDataTable;
use App\Helpers\Global\Constant;
use App\Http\Requests\Settings\UserRequest;
use App\Services\BloodType\BloodTypeService;
use App\Services\Role\RoleService;

class UserController extends Controller
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
   * Display a listing of the resource.
   */
  public function index(UserDataTable $dataTable, Request $request)
  {
    return $dataTable->addScope(new StatusFilter($request))->addScope(new RolesFilter($request))->render('settings.users.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $roles = $this->roleService->onlyOfficer()->first();
    return view('settings.users.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserRequest $request)
  {
    if ($request->roles === Constant::OFFICER) :
      $this->userService->handleCreateNewUser($request);
    else :
      abort(500, 'Internal Server Error, Silahkan hubungin admin');
    endif;

    return redirect()->route('users.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    $roles = $this->roleService->onlyOfficer()->first();
    return view('settings.users.edit', compact('roles', 'user'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, User $user)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    //
  }
}
