<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
  ];

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
   * Relation to user model.
   *
   * @return BelongsTo
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
