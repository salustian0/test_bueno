<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = Role::whereIn('role', ['Admin', 'Common'])->exists();

        if(empty($roles)){
            Role::create([
                'role' => 'Admin',
                'description' => 'Admin role'
            ]);
            Role::create([
                'role' => 'Common',
                'description' => 'Common user'
            ]);
        }

    }
}
