<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Site extends Model
{
  use Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'company_name',
    'company_phone',
    'company_logo',
    'company_address',
  ];

  /**
   * Return logo sites.
   *
   * @return void
   */
  public function getLogo()
  {
    return Storage::url($this->company_logo);
  }
}
