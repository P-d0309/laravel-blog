<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => "Admin",
            'email' => "admin@example.com",
            'password' => Hash::make("admin@123"),
        ];
        User::create($user);
    }
}
