<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tags = [
            '5G Ready',
            'Kamera Flagship',
            'Baterai Awet 5000mAh',
            'Fast Charging 120W',
            'Layar AMOLED 120Hz',
            'Garansi Resmi SEIN',
            'Garansi Resmi iBox',
            'Chipset Snapdragon',
            'Pilihan Gamers',
            'Best Seller Gadget',
            'Wireless Charging',
            'Water Resistant IP68',
        ];

        return [
            'name' => fake()->randomElement($tags).' '.fake()->numberBetween(1, 999),
        ];
    }
}
