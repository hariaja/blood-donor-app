<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BloodType extends Model
{
  use Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'type',
  ];

  /**
   * Get the route key for the model.
   * 
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Relation to donor model.
   *
   */
  public function donors(): HasMany
  {
    return $this->hasMany(Donor::class, 'blood_type_id');
  }
}
