<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
        ];

        foreach ($tags as $name) {
            Tag::firstOrCreate(['name' => $name]);
        }
    }
}
