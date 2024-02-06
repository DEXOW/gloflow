<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name' => 'ABC Enterprises PVT LTD',
                'email' => 'john@abc.lk',
                'contact_number' => '0112345678',
                'address' => 'No 123, Galle Road, Colombo 03',
                'status' => 'active',
            ],
            [
                'name' => 'XYZ Enterprises PVT LTD',
                'email' => 'rogers@xyz.lk',
                'contact_number' => '0112345678',
                'address' => 'No 123, Galle Road, Colombo 03',
                'status' => 'active',
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
