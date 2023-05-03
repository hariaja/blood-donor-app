<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use App\Helpers\Global\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
  use Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'user_id',
    'number',
    'last_donor',
    'return_donor',
    'urgency',
    'ramadan',
    'status',
    'message',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * The relationships that should always be loaded.
   *
   * @var array
   */
  protected $with = [
    'user',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'last_donor' => 'date:c',
    'return_donor' => 'date:c',
  ];

  /**
   * Scope a query to only include approved registration.
   */
  public function scopeApproved($data)
  {
    return $data->where('status', Constant::APPROVED);
  }

  public function getApproved(): Collection
  {
    return $this->approved()->get();
  }

  /**
   * Return last donor
   *
   * @return void
   */
  public function getLastDonor()
  {
    if (!$this->last_donor) {
      return '-';
    } else {
      return Helper::customDate($this->last_donor);
    }
  }

  /**
   * Return registration status
   *
   * @return void
   */
  public function isStatus()
  {
    if ($this->status === Constant::APPROVED) :
      return '<span class="badge text-success">' . Constant::APPROVED . '</span>';
    elseif ($this->status === Constant::REJECTED) :
      return '<span class="badge text-danger">' . Constant::REJECTED . '</span>';
    else :
      return '<span class="badge text-info">' . Constant::PENDING . '</span>';
    endif;
  }

  /**
   * Return past donor
   *
   * @return void
   */
  public function getReturnDonor()
  {
    if (!$this->return_donor) {
      return '-';
    } else {
      return Helper::customDate($this->return_donor);
    }
  }

  /**
   * Relation to user model.
   *
   * @return BelongsTo
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  /**
   * Relation to schedule model.
   *
   * @return HasMany
   */
  public function schedules(): HasMany
  {
    return $this->hasMany(Schedule::class, 'registration_id');
  }
}
