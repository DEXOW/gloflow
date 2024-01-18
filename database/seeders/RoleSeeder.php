<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
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
                'manage_products' => true,
                'manage_users' => true,
                'manage_roles' => true,
                'manage_content' => true,
            ],
            [
                'name' => 'user',
                'display_name' => 'User',
                'description' => 'User',
                'manage_products' => false,
                'manage_users' => false,
                'manage_roles' => false,
                'manage_content' => false,
            ],
            [
                'name' => 'sales_rep',
                'display_name' => 'Sales Representative',
                'description' => 'Sales Representative',
                'manage_products' => false,
                'manage_users' => false,
                'manage_roles' => false,
                'manage_content' => false,
            ],
            [
                'name' => 'manager',
                'display_name' => 'Manager',
                'description' => 'Manager',
                'manage_products' => true,
                'manage_users' => false,
                'manage_roles' => false,
                'manage_content' => false,
            ],
            [
                'name' => 'supplier',
                'display_name' => 'Supplier',
                'description' => 'Supplier',
                'manage_products' => false,
                'manage_users' => false,
                'manage_roles' => false,
                'manage_content' => false,
            ],
            [
                'name' => 'merchant',
                'display_name' => 'Merchant',
                'description' => 'Merchant',
                'manage_products' => false,
                'manage_users' => false,
                'manage_roles' => false,
                'manage_content' => false,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
