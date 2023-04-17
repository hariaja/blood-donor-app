<?php

namespace Database\Seeders;

use App\Helpers\Global\Constant;
use App\Models\BloodType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = [
      [
        'type' => Constant::UNKNOWN,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'type' => Constant::A,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'type' => Constant::B,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'type' => Constant::AB,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'type' => Constant::O,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    $collects = collect($items);
    foreach ($collects as $key => $value) :
      BloodType::firstOrCreate($value);
    endforeach;
  }
}
