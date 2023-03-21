<?php

namespace Database\Seeders;

use App\Models\ConstructionGroup;
use App\Models\Money;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        $this->call([
            RolePermissionSeeder::class,
        ]);
        User::create([
            'name' => 'create admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin@admin.com')
        ])->assignRole('admin');
        // \App\Models\Project::factory(10)->create();

        $values = [
            'CIVIL',
            'STEEL',
            'ELECTRIC',
            'SANITARY',
            'PAINTING',
        ];

        foreach ($values as $value) {
            ConstructionGroup::create([
                'name' => $value,
            ]);
        }

        // for ($i = 0; $i < 50; $i++) {
        //     Money::create([
        //         'in' => $i,
        //         'of' => now(),
        //         'project_id' => 1,
        //         'user_id' => 1
        //     ]);
        // }
    }
}