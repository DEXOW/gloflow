<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'it.admin@gloflow.com',
                'phone_number' => '',
                'password' => bcrypt('admin.password'), // Password for admin is "admin.password"
                'role_id' => 1,
            ],
            [
                'name' => 'John Doe',
                'email' => 'johndoe@gmail.com',
                'phone_number' => '0771234568',
                'password' => bcrypt('password'), // Password for user is "password"
                'role_id' => 2,
                'client_id' => 1,
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
