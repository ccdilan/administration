<?php

namespace Administration\Seeds;

use Administration\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(['id' => 1], ['name' => 'Super Admin', 'email' => 'super@cyntrek.com', 'password' => Hash::make('123456')]);
        User::firstOrCreate(['id' => 2], ['name' => 'System Admin', 'email' => 'admin@cyntrek.com', 'password' => Hash::make('123456')]);

        User::find(1)->assignRole('Super Admin');
        User::find(2)->assignRole('Admin');
    }
}
