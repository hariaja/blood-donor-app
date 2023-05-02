<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\RegistrationDataTable;
use App\Helpers\Global\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\RegistrationRequest;
use App\Models\Registration;
use App\Services\Registration\RegistrationService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected RegistrationService $registrationService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(RegistrationDataTable $dataTable)
  {
    return $dataTable->render('registrations.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    if (isRoleName() !== Constant::DONOR) :
      abort(403);
    elseif (me()->registrations->count() >= 1) :
    # code...
    else :
    # code...
    endif;

    return view('registrations.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RegistrationRequest $request)
  {
    $this->registrationService->handleNewRegistration($request);
    return redirect()->route('registrations.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Registration $registration)
  {
    return view('registrations.show', compact('registration'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Registration $registration)
  {
    $this->registrationService->handleUpdateStatus($registration, $request);
    return redirect()->route('registrations.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Registration $registration)
  {
    $this->registrationService->delete($registration->id);
    return response()->json([
      'message' => trans('session.delete')
    ]);
  }
}
