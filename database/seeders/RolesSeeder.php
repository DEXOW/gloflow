<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Administrator',
            ],
            [
                'name' => 'user',
                'display_name' => 'User',
                'description' => 'User',
            ],
            [
                'name' => 'sales_rep',
                'display_name' => 'Sales Representative',
                'description' => 'Sales Representative',
            ],
            [
                'name' => 'manager',
                'display_name' => 'Manager',
                'description' => 'Manager',
            ],
            [
                'name' => 'supplier',
                'display_name' => 'Supplier',
                'description' => 'Supplier',
            ],
            [
                'name' => 'merchant',
                'display_name' => 'Merchant',
                'description' => 'Merchant',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
