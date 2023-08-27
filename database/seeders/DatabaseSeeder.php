<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        $admin = new User();
        $admin->first_name = 'Admin';
        $admin->last_name = 'Admin';
        $admin->gender = 'Male';
        $admin->phone_number = '017941533';
        $admin->address = 'Phnom Penh';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make("123");
        $admin->role = 'Admin';
        $admin->created_by = 'Admin';
        $admin->save();
    }
}
