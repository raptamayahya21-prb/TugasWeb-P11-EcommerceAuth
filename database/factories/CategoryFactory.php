<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Elektronik & Gadget',
            'Busana & Pakaian',
            'Perabot & Rumah Tangga',
            'Kecantikan & Perawatan',
            'Olahraga & Aktivitas Luar',
            'Buku & Alat Tulis',
            'Mainan & Hobi',
            'Otomotif & Aksesoris',
            'Perlengkapan Rumah',
            'Makanan & Minuman Sehat',
            'Komputer & Laptop',
            'Kesehatan & Kebugaran',
        ];

        return [
            'name' => fake()->randomElement($categories).' '.fake()->numberBetween(1, 999),
        ];
    }
}
