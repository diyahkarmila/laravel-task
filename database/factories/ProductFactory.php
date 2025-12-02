<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $categories = Category::pluck('id')->toArray();
        
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraphs(2, true),
            'price' => $this->faker->numberBetween(10000, 1000000),
            'category_id' => $this->faker->randomElement($categories),
            'image' => $this->faker->imageUrl(640, 480, 'product', true),
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}