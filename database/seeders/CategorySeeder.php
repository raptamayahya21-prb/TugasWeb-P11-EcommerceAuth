<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
