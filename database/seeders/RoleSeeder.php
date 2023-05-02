<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Helpers\Global\Constant;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // reset cahced roles and permission
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    // Role Name
    $datas = [
      Constant::ADMIN,
      Constant::OFFICER,
      Constant::DONOR,
    ];

    foreach ($datas as $data) :
      $roles = Role::create([
        'name' => $data,
        'guard_name' => 'web'
      ]);
    endforeach;

    $officer = $roles->where('name', Constant::OFFICER)->first();
    $officer->syncPermissions(
      Permission::where('name', 'LIKE', 'users.show')
        ->orWhere('name', 'LIKE', 'users.update')
        ->orWhere('name', 'LIKE', 'users.password')
        ->orWhere('name', 'LIKE', 'registrations.%')
        ->get()
    );

    $donor = $roles->where('name', Constant::DONOR)->first();
    $donor->syncPermissions(
      Permission::where('name', 'LIKE', 'donors.show')
        ->orWhere('name', 'LIKE', 'donors.update')
        ->orWhere('name', 'LIKE', 'users.password')
        ->orWhere('name', 'LIKE', 'registrations.index')
        ->orWhere('name', 'LIKE', 'registrations.create')
        ->orWhere('name', 'LIKE', 'registrations.store')
        ->orWhere('name', 'LIKE', 'registrations.show')
        ->get()
    );
  }
}
