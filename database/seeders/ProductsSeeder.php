<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Comfort After Wash Morning Fresh Fabric Conditioner 860ml',
                'description' => 'Gives Unbelievable Shine to Clothes comfort nourishes and untangles cloth fibers damaged by washing and gives clothes an unbelievable shine with Fragrance Pearls for Long Lasting Freshness. Makes Clothes soft, smooth & great to wear leaves clothes feeling soft, smooth and great to wear',
                'image' => 'https://www.ustore.lk/cdn/shop/products/1646050904_5595_592x592.png?v=1696327369',
                'tags'=> 'comfort,after wash,morning fresh,fabric conditioner,860ml',
            ],
            [
                'name' => 'Surf Excel Matic Top Load Washing Liquid 1L',
                'description' => 'New Surf Excel Matic liquid top load washing detergent gives you 100percent tough stain removal in washing machines. Faster Stain Removal in Machines. New Surf excel matic liquid detergent with a powerful cleaning technology penetrates stains faster and removes tough stains in machines itself. Easy and Better Dissolution. Being liquid detergent it dissolves quickly in high water level environment of washing machines reaches stains effortlessly and leaves no residue on clothes or in machines',
                'image' => 'https://www.ustore.lk/cdn/shop/products/1650390091_1852_1af1ff81-229e-46d1-a434-35aa39924367_592x592.png?v=1696393913',
                'tags'=> 'surf excel,matic,top load,washing liquid,1l',
            ],
            [
                'name' => 'Surf Excel Matic Front Load Detergent Liquid 1l',
                'description' => 'Being liquid its best suited for washing machines and ensures a superior laundry experience and offers the following benefits 1. FASTER STAIN REMOVAL New Surf Excel Matic liquid with a powerful cleaning technology penetrates stains faster and removes tough stains in the machine itself. 2. EASY and BETTER DISSOLUTION Its liquid format helps it dissolve easily in the high water level environment of washing machines, reaches stains effortlessly and leaves no residue on clothes or in machines. 3. SUPERIOR FRAGRANCE It ensures that your clothes not only look fresh but also smell fresh and are safe on your hands. COLOUR CARE It removes tough stains in machines but retains the original color of the fabric. 4. MACHINE CARE Being liquid it leaves no residue, causing no scaling and produces the right amount of foam',
                'image' => 'https://www.ustore.lk/cdn/shop/products/1650620372_4568_592x592.png?v=1696393915',
                'tags'=> 'surf excel,matic,front load,detergent liquid,1l',
            ],
            [
                'name' => 'Surf Excel With Comfort Laundry Detergent Powder 1kg',
                'description' => 'Surf excel now with premium fragrance of comfort. For the first time, get superior benefits of both, surf and comfort in 1 product. Specially formulated to remove tough stains from deep within the fabric of the clothes. It also infuses a long-lasting floral fragrance into your clothes, leaving them smelling fresh and fragrant after every wash. This powder leaves your clothes smelling fresh, looking clean and does not leave any residue. Get superior clean and long - lasting fragrance while being gentle on your hands during wash.',
                'image' => 'https://www.ustore.lk/cdn/shop/products/1653041460_2708_592x592.png?v=1696327379',
                'tags'=> 'surf excel,comfort,laundry detergent,powder,1kg',
            ],
            [
                'name' => 'Signal Strong Teeth Toothpaste 120g',
                'description' => 'Signal Strong teeth Dual Action  Protection with microcalcium  pro fluoride complex works every minute, day and at night to care for your teeth. Day Action  prevents cavities caused by food  drinks. Night Action  The formula works harder, detecting  repairing tiny invisible holes even hours after brushing.',
                'image' => 'https://www.ustore.lk/cdn/shop/products/1684141228_2462_46ca0d03-3791-4380-9f1a-217c161bfa13_1080x1080.png?v=1696504587',
                'tags'=> 'signal,strong teeth,toothpaste,120g',
            ]
        ];
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
