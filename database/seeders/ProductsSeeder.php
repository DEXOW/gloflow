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
                'name' => 'Surf Excel Matic Top Load Washing Liquid 1L',
                'description' => 'New Surf Excel Matic liquid top load washing detergent gives you 100percent tough stain removal in washing machines. Faster Stain Removal in Machines. New Surf excel matic liquid detergent with a powerful cleaning technology penetrates stains faster and removes tough stains in machines itself. Easy and Better Dissolution. Being liquid detergent it dissolves quickly in high water level environment of washing machines reaches stains effortlessly and leaves no residue on clothes or in machines',
                'image' => 'assets/images/products/1696606839.webp',
                'tags'=> 'surf excel,matic,top load,washing liquid,1l',
            ],
            [
                'name' => 'Surf Excel Matic Front Load Detergent Liquid 1l',
                'description' => 'Being liquid its best suited for washing machines and ensures a superior laundry experience and offers the following benefits 1. FASTER STAIN REMOVAL New Surf Excel Matic liquid with a powerful cleaning technology penetrates stains faster and removes tough stains in the machine itself. 2. EASY and BETTER DISSOLUTION Its liquid format helps it dissolve easily in the high water level environment of washing machines, reaches stains effortlessly and leaves no residue on clothes or in machines. 3. SUPERIOR FRAGRANCE It ensures that your clothes not only look fresh but also smell fresh and are safe on your hands. COLOUR CARE It removes tough stains in machines but retains the original color of the fabric. 4. MACHINE CARE Being liquid it leaves no residue, causing no scaling and produces the right amount of foam',
                'image' => 'assets/images/products/1696606879.webp',
                'tags'=> 'surf excel,matic,front load,detergent liquid,1l',
            ],
            [
                'name' => 'Surf Excel With Comfort Laundry Detergent Powder 1kg',
                'description' => 'Surf excel now with premium fragrance of comfort. For the first time, get superior benefits of both, surf and comfort in 1 product. Specially formulated to remove tough stains from deep within the fabric of the clothes. It also infuses a long-lasting floral fragrance into your clothes, leaving them smelling fresh and fragrant after every wash. This powder leaves your clothes smelling fresh, looking clean and does not leave any residue. Get superior clean and long - lasting fragrance while being gentle on your hands during wash.',
                'image' => 'assets/images/products/1696606889.webp',
                'tags'=> 'surf excel,comfort,laundry detergent,powder,1kg',
            ],
            [
                'name' => 'Dove Intense Repair Shampoo 180ml',
                'description' => 'At Dove we are dedicated to providing superior nourishment solutions for hair. Dove Intense Repair, with Keratin Actives, works immediaetly to repair the hair surface, while deeply nourishing the core of your hair to reconstruct it from within & make it healthier in the long run. Everytime you use it, your hair is repaired, strong and beautiful. Combine with Dove Conditioner everytime you shampoo for nourished, frizz protected hair.',
                'image' => 'assets/images/products/1696606937.webp',
                'tags'=> 'dove,intense,repair,shampoo,180ml',
            ],
            [
                'name' => 'Lux Soft Skin French Rose and Almond oil Bodywash 240ml',
                'description' => 'Lux Soft Skin, French Rose & Almond Oil Bodywash, 240ml',
                'image' => 'assets/images/products/1696607076.webp',
                'tags'=> 'lux, rose, french, almond oil, bodywash, 240ml',
            ],
            [
                'name' => 'Closeup Eucalyptus Mint Toothpaste 120g',
                'description' => 'Closeup Triple Fresh Formula, with the combined power of 3 ingredients, gives you up to 12 hours of fresh breath. Because long-lasting freshness starts with complete cleaning and protection.',
                'image' => 'assets/images/products/1696607127.webp',
                'tags'=> 'closeup,eucalyptus,mint,toothpaste,120g',
            ],
            [
                'name' => 'Signal Strong Teeth Toothpaste 120g',
                'description' => 'Signal Strong teeth Dual Action  Protection with microcalcium  pro fluoride complex works every minute, day and at night to care for your teeth. Day Action  prevents cavities caused by food  drinks. Night Action  The formula works harder, detecting  repairing tiny invisible holes even hours after brushing.',
                'image' => 'assets/images/products/1696606898.webp',
                'tags'=> 'signal,strong teeth,toothpaste,120g',
            ]
        ];
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
