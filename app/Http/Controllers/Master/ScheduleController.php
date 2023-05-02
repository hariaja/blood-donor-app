<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\ScheduleDataTable;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ScheduleRequest;
use App\Services\Registration\RegistrationService;
use App\Services\Schedule\ScheduleService;

class ScheduleController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected ScheduleService $scheduleService,
    protected RegistrationService $registrationService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(ScheduleDataTable $scheduleDataTable)
  {
    return $scheduleDataTable->render('schedules.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $registrations = $this->registrationService->getApprovedOnly()->get();
    return view('schedules.create', compact('registrations'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ScheduleRequest $request)
  {
    $this->scheduleService->create($request->all());
    return redirect()->route('schedules.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Schedule $schedule)
  {
    return response()->json([
      'schedule' => $schedule
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Schedule $schedule)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Schedule $schedule)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Schedule $schedule)
  {
    //
  }
}
