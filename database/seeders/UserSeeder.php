<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =  User::where('name', 'Master admin')->exists();
        $roleAdmin = Role::where('role', 'Admin')->first();

        if(!$user){
           $user =  User::create([
                'name' => 'Master admin',
                'email' => 'admin@admin.com',
                'password' => 'admin@123'
            ]);

           $user->roles()->attach($roleAdmin->id);
        }
    }
}
