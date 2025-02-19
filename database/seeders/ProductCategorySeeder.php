<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Alat Olahraga', 'Alat Musik'];

        foreach ($categories as $category) {
            ProductCategory::create(['name' => $category]);
        }
    }
}
