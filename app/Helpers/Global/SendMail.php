<?php

namespace App\Helpers\Global;

use Illuminate\Support\Facades\Mail;
use App\Mail\Schedules\InvitationMail;
use App\Mail\Schedules\ChangeScheduleMail;
use App\Mail\Registrations\RegistrationApproved;
use App\Mail\Registrations\RegistrationRejected;

class SendMail
{
  public static function sendApprovedEmail($registration, $request)
  {
    $data = array();
    $data['name'] = $registration->user->name;
    $data['email'] = $registration->user->email;
    $data['phone'] = $registration->user->phone;
    $data['created_at'] = Helper::customDate($registration->created_at, true);
    $data['status'] = $request->status;
    $data['approved_by'] = me()->name;

    return Mail::to($registration->user->email)->send(new RegistrationApproved($data));
  }

  public static function sendRejectedEmail($registration, $request)
  {
    $data = array();
    $data['name'] = $registration->user->name;
    $data['email'] = $registration->user->email;
    $data['phone'] = $registration->user->phone;
    $data['created_at'] = Helper::customDate($registration->created_at, true);
    $data['status'] = $request->status;
    $data['message'] = $request->message;
    $data['approved_by'] = me()->name;

    return Mail::to($registration->user->email)->send(new RegistrationRejected($data));
  }

  public static function sendInvitationMail($registration, $request)
  {
    $data = array();
    $data['name'] = $registration->user->name;
    $data['email'] = $registration->user->email;
    $data['date'] = Helper::customDate($request->date);
    $data['time'] = $request->time;

    return Mail::to($data['email'])->send(new InvitationMail($data));
  }

  public static function sendChangeInvitationMail($schedule, $request)
  {
    $data = array();
    $data['name'] = $schedule->registration->user->name;
    $data['email'] = $schedule->registration->user->email;
    $data['date'] = Helper::customDate($request->date);
    $data['time'] = $request->time;

    return Mail::to($data['email'])->send(new ChangeScheduleMail($data));
  }
}
