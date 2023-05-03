<?php

namespace App\Models;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
  use Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'registration_id',
    'date',
    'location',
    'address',
    'status',
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
    'registration',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'date' => 'date:c',
  ];

  /**
   * Schedule status.
   *
   * @return void
   */
  public function isStatus()
  {
    if ($this->status === Constant::HAVE_ARRIVED) :
      return '<span class="badge text-success">' . Constant::HAVE_ARRIVED . '</span>';
    else :
      return '<span class="badge text-danger">' . Constant::NOT_YET_COME . '</span>';
    endif;
  }

  /**
   * Relation to registration model.
   *
   * @return BelongsTo
   */
  public function registration(): BelongsTo
  {
    return $this->belongsTo(Registration::class, 'registration_id');
  }
}
