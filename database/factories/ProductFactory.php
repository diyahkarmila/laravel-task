<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $cakeNames = [
            'Chocolate Fudge Cake', 'Red Velvet Cake', 'Cheesecake', 'Carrot Cake',
            'Tiramisu Cake', 'Black Forest Cake', 'Lemon Drizzle Cake', 'Vanilla Sponge Cake',
            'Strawberry Shortcake', 'Banana Bread', 'Croissant', 'Macarons',
            'Cinnamon Roll', 'Donut', 'Muffin', 'Brownie', 'Cookie', 'Baguette',
            'Sourdough Bread', 'Pancake', 'Waffle', 'Eclair', 'Cupcake', 'Pie',
            'Tart', 'Biscotti', 'Pretzel', 'Brioche', 'Bagel', 'Danish Pastry'
        ];

        return [
            'name' => $this->faker->randomElement($cakeNames),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->numberBetween(20000, 500000),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}