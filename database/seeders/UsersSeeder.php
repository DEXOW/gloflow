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
                'name' => 'Thinal Perera',
                'email' => 'thinaltp@gmail.com',
                'phone_number' => '0771234567',
                'address' => 'No 1, Galle Road, Colombo 03',
                'password' => bcrypt('password'),
                'role_id' => 1,
            ],
            [
                'name' => 'Dexow',
                'email' => 'dexow5000@gmail.com',
                'phone_number' => '0771234567',
                'address' => 'No 2, Galle Road, Colombo 03',
                'password' => bcrypt('password'),
                'role_id' => 2,
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
