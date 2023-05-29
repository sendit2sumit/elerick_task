<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
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

        $users = [
            [
                'role_id' => Role::ADMIN,
                'name' => 'Admin',
                'email' => 'elerickadmin@yopmail.com',
                'password' => \Hash::make('12345678'),
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        Schema::enableForeignKeyConstraints();
    }
}
