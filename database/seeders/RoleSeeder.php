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
        $roles = [
            [
                'name' => 'prodi',
                'redirect_to' => '/'
            ],
            [
                'name' => 'taskforce',
                'redirect_to' => '/'
            ],
            [
                'name' => 'assessor',
                'redirect_to' => '/'
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
