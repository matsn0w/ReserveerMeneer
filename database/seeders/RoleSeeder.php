<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'DEFAULT',
            'description' => 'Default application user',
        ]);

        Role::create([
            'name' => 'ADMIN',
            'description' => 'Acts as platform owner',
        ]);
    }
}
