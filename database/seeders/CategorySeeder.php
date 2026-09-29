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
            'Elektronik & Gadget',
            'Busana & Pakaian',
            'Perabot & Rumah Tangga',
            'Kecantikan & Perawatan',
            'Olahraga & Aktivitas Luar',
            'Buku & Alat Tulis',
            'Mainan & Hobi',
            'Otomotif & Aksesoris',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
