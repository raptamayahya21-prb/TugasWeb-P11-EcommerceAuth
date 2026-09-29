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
            'Terlaris',
            'Produk Baru',
            'Promo Spesial',
            'Edisi Terbatas',
            'Ramah Lingkungan',
            'Pilihan Editor',
            'Sedang Tren',
            'Diskon Eksklusif',
            'Kualitas Premium',
            'Cuci Gudang',
            'Gratis Ongkir',
            'Garansi Resmi',
        ];

        return [
            'name' => fake()->randomElement($tags).' '.fake()->numberBetween(1, 999),
        ];
    }
}
