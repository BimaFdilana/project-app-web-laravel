<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $roleUsers = [
            [
                'name' => 'Prodi User',
                'email' => 'prodi@example.com',
                'role_name' => 'prodi',
            ],
            [
                'name' => 'Taskforce User',
                'email' => 'taskforce@example.com',
                'role_name' => 'taskforce',
            ],
            [
                'name' => 'Assessor User',
                'email' => 'assessor@example.com',
                'role_name' => 'assessor',
            ],
        ];

        foreach ($roleUsers as $data) {
            $role = Role::where('name', $data['role_name'])->first();

            if ($role) {
                User::firstOrCreate(
                    ['email' => $data['email']],
                    [
                        'name' => $data['name'],
                        'email_verified_at' => now(),
                        'password' => Hash::make('password'),
                        'role_id' => $role->id,
                    ]
                );
            }
        }
    }
}