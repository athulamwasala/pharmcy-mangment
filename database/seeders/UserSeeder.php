<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create owner user
        User::create([
            'name' => 'Owner_User',
            'username' => 'owner',
            'password' => bcrypt('123456'),
            'role' => User::ROLE_OWNER,
        ]);

        // Create manager user
        User::create([
            'name' => 'Manager_User',
            'username' => 'manager',
            'password' => bcrypt('123456'),
            'role' => User::ROLE_MANAGER,
        ]);

         // Create cashier user
        User::create([
            'name' => 'Cashier_User',
            'username' => 'cashier',
            'password' => bcrypt('123456'),
            'role' => User::ROLE_CASHIER,
        ]);


    }
}
