<?php

namespace Database\Seeders;

use App\Helpers\Global\Constant;
use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $company = new Site;
    $company->company_name = config('site.company.name');
    $company->company_phone = config('site.company.phone');
    $company->company_logo = config('site.company.logo');
    $company->company_address = config('site.company.address');
    $company->save();
  }
}
