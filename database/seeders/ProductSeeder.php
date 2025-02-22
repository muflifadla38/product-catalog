<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Jersey Liverpool',
                'purchase_price' => 1250000,
                'selling_price' => 1625000,
                'stock' => 120,
                'product_category_id' => 1,
            ],
            [
                'name' => 'Dumbbell 5kg',
                'purchase_price' => 80000,
                'selling_price' => 104000,
                'stock' => 25,
                'product_category_id' => 1,
            ],
            [
                'name' => 'Yoga Mat',
                'purchase_price' => 120000,
                'selling_price' => 156000,
                'stock' => 30,
                'product_category_id' => 1,
            ],
            [
                'name' => 'Gitar Akustik',
                'purchase_price' => 1000000,
                'selling_price' => 1300000,
                'stock' => 10,
                'product_category_id' => 2,
            ],
            [
                'name' => 'Drum Set',
                'purchase_price' => 2200000,
                'selling_price' => 2860000,
                'stock' => 5,
                'product_category_id' => 2,
            ],
            [
                'name' => 'Bola Basket',
                'purchase_price' => 60000,
                'selling_price' => 78000,
                'stock' => 40,
                'product_category_id' => 1,
            ],
            [
                'name' => 'Piano Elektrik',
                'purchase_price' => 3000000,
                'selling_price' => 3900000,
                'stock' => 3,
                'product_category_id' => 2,
            ],
            [
                'name' => 'Treadmill',
                'purchase_price' => 2000000,
                'selling_price' => 2600000,
                'stock' => 7,
                'product_category_id' => 1,
            ],
            [
                'name' => 'Biola',
                'purchase_price' => 1400000,
                'selling_price' => 1820000,
                'stock' => 8,
                'product_category_id' => 2,
            ],
            [
                'name' => 'Sepatu Lari',
                'purchase_price' => 200000,
                'selling_price' => 260000,
                'stock' => 20,
                'product_category_id' => 1,
            ],
        ];

        Product::insert($products);

        // Product::factory(100)->create();
    }
}
