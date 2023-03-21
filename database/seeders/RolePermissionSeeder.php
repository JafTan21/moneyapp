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
        $admin_role = Role::create(['name' => 'admin']);

        $money =   Permission::create(['name' => 'view-money-page']);
        $project = Permission::create(['name' => 'view-projects-page']);
        $sub =  Permission::create(['name' => 'view-sub-contracts-page']);
        $labor =   Permission::create(['name' => 'view-labor-page']);
        $bill =   Permission::create(['name' => 'view-bill-page']);
        $supplier =  Permission::create(['name' => 'view-supplier-page']);
        $material =  Permission::create(['name' => 'view-material-page']);
        $contracted = Permission::create(['name' => 'view-contracted-form']);

        $admin_role->syncPermissions(Permission::all());
    }
}