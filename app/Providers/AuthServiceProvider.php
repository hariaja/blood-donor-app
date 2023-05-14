<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Laravel\Passport\Passport;
use App\Helpers\Global\Constant;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The model to policy mappings for the application.
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
  ];

  /**
   * Register any authentication / authorization services.
   */
  public function boot(): void
  {
    Passport::tokensExpireIn(Carbon::now()->addDays(1));
    Passport::refreshTokensExpireIn(Carbon::now()->addDays(10));

    Gate::before(function ($user, $ability) {
      return $user->hasRole(Constant::ADMIN) ? true : null;
    });
  }
}
