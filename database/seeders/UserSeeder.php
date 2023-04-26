<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // User Admin
    User::create([
      'name' => Constant::ADMIN,
      'email' => 'admin@gmail.com',
      'phone' => '+6285798888733',
      'email_verified_at' => now(),
      'password' => bcrypt('password'),
      'status' => Constant::ACTIVE
    ])->assignRole(Constant::ADMIN);

    // User officer
    for ($i = 1; $i <= 5; $i++) :
      $officer = User::factory()->create();
      $officer->assignRole(Constant::OFFICER);
    endfor;
  }
}
