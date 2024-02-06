<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\RetailProduct;
use Illuminate\Database\Seeder;

class RetailProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Surf Excel Matic Top Load Washing Liquid 1L',
                'group' => 'Detergent',
                'case_config' => 6,
                'unit_price' => 100,
                'lower_limit' => 0,
                'upper_limit' => 100
            ],
            [
                'name' => 'Surf Excel Matic Front Load Detergent Liquid 1l',
                'group' => 'Detergent',
                'case_config' => 6,
                'unit_price' => 200,
                'lower_limit' => 0,
                'upper_limit' => 100
            ],
            [
                'name' => 'Surf Excel With Comfort Laundry Detergent Powder 1kg',
                'group' => 'Detergent',
                'case_config' => 6,
                'unit_price' => 300,
                'lower_limit' => 0,
                'upper_limit' => 100
            ],
            [
                'name' => 'Dove Intense Repair Shampoo 180ml',
                'group' => 'Shampoo',
                'case_config' => 20,
                'unit_price' => 400,
                'lower_limit' => 0,
                'upper_limit' => 100
            ],
            [
                'name' => 'Lux Soft Skin French Rose and Almond oil Bodywash 240ml',
                'group' => 'Bodywash',
                'case_config' => 12,
                'unit_price' => 500,
                'lower_limit' => 0,
                'upper_limit' => 100
            ],
            [
                'name' => 'Closeup Eucalyptus Mint Toothpaste 120g',
                'group' => 'Toothpaste',
                'case_config' => 24,
                'unit_price' => 600,
                'lower_limit' => 0,
                'upper_limit' => 100
            ],
            [
                'name' => 'Signal Strong Teeth Toothpaste 120g',
                'group' => 'Toothpaste',
                'case_config' => 24,
                'unit_price' => 700,
                'lower_limit' => 0,
                'upper_limit' => 100
            ]
        ];

        foreach ($products as $product) {
            RetailProduct::create($product);
        }
    }
}
