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
            'Smartphone Flagship',
            'Smartphone Mid-Range',
            'Smartphone Entry-Level',
            'Tablet & iPad',
            'Smartwatch & Wearable',
            'Audio & TWS Nirkabel',
            'Powerbank & Pengisi Daya',
            'Casing & Aksesoris Gadget',
            'Aksesoris Fotografi HP',
            'Kabel Data & Konverter',
        ];

        return [
            'name' => fake()->randomElement($categories).' '.fake()->numberBetween(1, 999),
        ];
    }
}
