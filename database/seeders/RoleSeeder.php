<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        Schema::disableForeignKeyConstraints();

        User::truncate();

        $roles = [
            [
                'name' => 'Admin',
                'display_name' => 'admin',
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        Schema::enableForeignKeyConstraints();
    }
}
