<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'admin',
            'nim' => '1234567890',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
            'role_id' => 1,
        ];

        User::create($user);
    }
}