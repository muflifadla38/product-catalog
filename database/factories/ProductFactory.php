<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'purchase_price' => fake()->randomNumber(4),
            'selling_price' => fake()->randomNumber(4),
            'stock' => fake()->randomNumber(2),
            'product_category_id' => rand(1, 2),
        ];
    }
}
