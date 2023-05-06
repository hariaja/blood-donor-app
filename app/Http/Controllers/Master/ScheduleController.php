<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\ScheduleDataTable;
use App\DataTables\Scopes\StatusFilter;
use App\Helpers\Global\Helper;
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
  public function index(ScheduleDataTable $scheduleDataTable, Request $request)
  {
    return $scheduleDataTable->addScope(new StatusFilter($request))->render('schedules.index');
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
    $schedule->last_donor = Helper::customDate($schedule->registration->last_donor);
    $schedule->return_donor = Helper::customDate($schedule->registration->return_donor);
    $schedule->take_date = Helper::customDate($schedule->date);

    return response()->json([
      'schedule' => $schedule
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Schedule $schedule)
  {
    $registrations = $this->registrationService->getApprovedOnly()->get();
    return view('schedules.edit', compact('schedule', 'registrations'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ScheduleRequest $request, Schedule $schedule)
  {
    $this->scheduleService->update($schedule->id, $request->all());
    return redirect()->route('schedules.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Schedule $schedule)
  {
    $this->scheduleService->delete($schedule->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
