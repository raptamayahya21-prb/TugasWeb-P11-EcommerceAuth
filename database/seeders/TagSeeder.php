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
        ];

        foreach ($tags as $name) {
            Tag::firstOrCreate(['name' => $name]);
        }
    }
}
