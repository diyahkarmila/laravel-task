<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Elektronik',
                'slug' => 'elektronik',
                'description' => 'Produk-produk elektronik terbaru seperti smartphone, laptop, dan gadget'
            ],
            [
                'name' => 'Pakaian',
                'slug' => 'pakaian',
                'description' => 'Fashion dan pakaian terbaru untuk semua usia'
            ],
            [
                'name' => 'Makanan & Minuman',
                'slug' => 'makanan-minuman',
                'description' => 'Makanan dan minuman berkualitas dengan berbagai pilihan'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}