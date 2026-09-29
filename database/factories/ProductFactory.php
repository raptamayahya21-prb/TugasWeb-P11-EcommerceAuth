<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productTitles = [
            'Kemeja Katun Flanel Pria Lengan Panjang',
            'Sepatu Sneakers Kulit Minimalis',
            'Lampu Meja Kerja LED Sensor Sentuh',
            'Headphone Nirkabel Noise Cancelling',
            'Tas Ransel Laptop Tahan Air',
            'Botol Minum Termos Stainless Steel 500ml',
            'Buku Agenda Jurnal Harian Sampul Kulit',
            'Pembersih Wajah Herbal Alami',
            'Jaket Hoodie Katun Fleece Hangat',
            'Jam Tangan Quartz Analog Klasik',
            'Set Pisau Dapur Stainless Steel 6 Pcs',
            'Matras Yoga Anti Slip Ekologis',
            'Speaker Bluetooth Portabel Bass Jernih',
            'Serum Wajah Pencerah Kulit Niacinamide',
            'Kacamata Hitam Polarized UV400',
            'Mouse Nirkabel Ergonomis Silent Click',
            'Bantal Tidur Memory Foam Ergonomis',
            'Dompet Kulit Asli Lipat Minimalis',
            'Blender Portabel USB Juicer Smoothie',
            'Payung Lipat Otomatis Tahan Angin',
            'Kaus Polos Katun Combed 30s Lembut',
            'Wajan Penggorengan Anti Lengket Granit',
            'Keyboard Mekanikal Kompak RGB Wireless',
            'Diffuser Aromaterapi Ultrasonik Lampu Malam',
            'Celana Chino Slim Fit Pria Stretch',
            'Powerbank Fast Charging 20000mAh',
            'Cangkir Kopi Keramik Handmade Estetik',
            'Tas Selempang Kulit Sintetis Elegan',
            'Sandal Slop Kasual Pria & Wanita',
            'Humidifier Ruangan Mini USB Otomatis',
            'Earphone True Wireless Stereo Bluetooth 5.3',
            'Sabun Cuci Muka Pria Deep Clean Refreshing',
            'Sepatu Olahraga Lari Breathable Ringan',
            'Topi Baseball Katun Klasik Adjustable',
            'Kabel Data Fast Charging Type-C 100W',
            'Lilin Aromaterapi Lilin Kedelai Alami',
            'Sisir Kayu Bambu Alami Anti Rontok',
            'Kotak Makan Bento Sekat Stainless Steel',
            'Rak Meja Komputer Kayu Solid Minimalis',
            'Tas Belanja Lipat Ramah Lingkungan Tahan Air',
        ];

        $adjectives = [
            'Edisi Khusus',
            'Seri Premium',
            'Varian Pro',
            'Model Terbaru',
            'Koleksi Eksklusif',
            'Edisi Klasik',
            'Generasi 2',
            'Kualitas Terbaik',
        ];

        $descriptions = [
            'Dibuat dari material pilihan bermutu tinggi yang memberikan kenyamanan maksimal dan ketahanan jangka panjang untuk aktivitas harian Anda.',
            'Desain minimalis dan modern yang elegan, cocok untuk kebutuhan profesional maupun santai. Dilengkapi jaminan garansi resmi toko.',
            'Produk unggulan dengan pengerjaan presisi dan detail rapi. Memberikan performa optimal serta mudah dibersihkan dan dirawat.',
            'Solusi praktis dan modis untuk menunjang produktivitas gaya hidup masa kini. Telah lolos uji kendali mutu sebelum dikemas.',
            'Material ramah lingkungan dengan daya tahan prima. Pilihan cerdas bagi Anda yang mengutamakan kualitas, estetika, dan fungsionalitas.',
            'Hadir dengan teknologi mutakhir dan material premium yang awet digunakan. Sangat direkomendasikan untuk penggunaan jangka panjang.',
        ];

        $name = fake()->randomElement($productTitles) . ' ' . fake()->randomElement($adjectives);
        $description = fake()->randomElement($descriptions) . ' ' . fake()->randomElement($descriptions);

        return [
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'name' => $name,
            'sku' => fake()->unique()->regexify('[A-Z]{3}-[0-9]{4}-[A-Z]{2}'),
            // Harga dalam Rupiah (kelipatan 1.000 atau 5.000 antara Rp 15.000 s/d Rp 4.500.000)
            'price' => (float) (fake()->numberBetween(15, 4500) * 1000),
            'stock' => fake()->numberBetween(0, 350),
            'description' => $description,
            'discount_percentage' => fake()->randomElement([0, 0, 5, 10, 15, 20, 25, 30, 50]),
            'rating' => fake()->randomFloat(1, 4.0, 5.0),
            'thumbnail' => "https://picsum.photos/640/480?random={$this->generateNumberBetween(1, 1000)}",
        ];
    }

    private function generateNumberBetween(int $min = 0, int $max = 1000): int
    {
        return fake()->numberBetween($min, $max);
    }
}
