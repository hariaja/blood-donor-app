<?php

namespace App\Http\Controllers;

use App\Helpers\Global\Dashboard;
use App\Services\Donor\DonorService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(protected UserService $userService)
  {
    $this->middleware(['auth', 'verified']);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $data = array();
    $data['dashboard'] = new Dashboard;
    return view('home', $data);
  }
}
