<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use App\Helpers\Global\Helper;
use App\Models\Donor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DonorSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $user = User::create([
      'name' => 'Anita Rahayu Sutira',
      'email' => 'anita@gmail.com',
      'phone' => '+6285798889000',
      'email_verified_at' => now(),
      'password' => bcrypt('password'),
      'status' => Constant::ACTIVE,
    ])->assignRole(Constant::DONOR);

    $dateBirth = date('Y-m-d', strtotime('01-01-2000'));
    $age = Helper::convertToAge($dateBirth);

    Donor::create([
      'user_id' => $user->id,
      'blood_type_id' => 1,
      'nik' => '3321111508050023',
      'gender' => Constant::MALE,
      'rhesus' => Constant::POSITIF,
      'birth_date' => $dateBirth,
      'age' => $age,
      'job_title' => 'Mahasiswa',
      'address' => 'Kp. Kebon Randu RT 001/022 Kec. Cibadak, Kab. Sukabumi, Jawa Barat Indonesia 43351',
    ]);
  }
}
