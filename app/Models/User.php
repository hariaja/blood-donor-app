<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable, Uuid, HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'phone',
    'password',
    'avatar',
    'status',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The relationships that should always be loaded.
   *
   * @var array
   */
  // protected $with = [
  //   'donor',
  // ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Get the user avatar.
   *
   */
  public function getAvatar()
  {
    if (!$this->avatar) {
      return asset('assets/images/default.png');
    } else {
      return Storage::url($this->avatar);
    }
  }

  /**
   * Get the user role name.
   */
  public function isRoleName(): string
  {
    return $this->roles->implode('name');
  }

  /**
   * Get the user role id.
   */
  public function isRoleId(): int
  {
    return $this->roles->implode('id');
  }

  /**
   * Get all user, exclude administrator.
   *
   * @param  mixed $query
   * @return void
   */
  public function scopeExcludeAdmin($query)
  {
    return $query->whereDoesntHave('roles', function ($q) {
      $q->where('name', Constant::ADMIN);
    });
  }

  /**
   * Get the user status account.
   *
   */
  public function isStatus()
  {
    if ($this->status == Constant::ACTIVE) :
      return '<span class="badge text-success">Active</span>';
    else :
      return '<span class="badge text-danger">Inactive</span>';
    endif;
  }

  /**
   * Scope a query to only include active users.
   */
  public function scopeActive($data)
  {
    return $data->where('status', Constant::ACTIVE);
  }

  public function getActive(): Collection
  {
    return $this->active()->get();
  }

  /**
   * Scope a query to only include inactive users.
   */
  public function scopeInactive($data)
  {
    return $data->where('status', Constant::INACTIVE);
  }

  public function getInactive(): Collection
  {
    return $this->inactive()->get();
  }

  /**
   * Relation to donor model.
   *
   * @return HasOne
   */
  public function donor(): HasOne
  {
    return $this->hasOne(Donor::class, 'user_id');
  }

  /**
   * Relation to registration model.
   *
   * @return HasMany
   */
  public function registrations(): HasMany
  {
    return $this->hasMany(Registration::class, 'user_id');
  }
}
