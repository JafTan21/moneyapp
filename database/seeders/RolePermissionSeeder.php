<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'normal']);
        Role::create(['name' => 'admin']);

        Permission::create(['name' => 'view-money-page']);
        Permission::create(['name' => 'view-projects-page']);
        Permission::create(['name' => 'view-sub-contracts-page']);
        Permission::create(['name' => 'view-labor-page']);
        Permission::create(['name' => 'view-bill-page']);
        Permission::create(['name' => 'view-supplier-page']);
    }
}