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
        $gadgets = [
            // Smartphone Flagship
            [
                'name' => 'Samsung Galaxy S24 Ultra 12GB/512GB Titanium Gray',
                'price' => 21999000,
                'desc' => 'Ditenagai Snapdragon 8 Gen 3 for Galaxy, kamera utama 200MP Quad Telephoto dengan Galaxy AI. Layar Dynamic AMOLED 2X 120Hz dan bodi titanium kokoh. Garansi Resmi SEIN 1 Tahun.',
            ],
            [
                'name' => 'iPhone 15 Pro Max 256GB Natural Titanium',
                'price' => 23499000,
                'desc' => 'Chipset Apple A17 Pro 3nm terkencang, desain bodi titanium grade aerospace dengan tombol Action Button. Sistem kamera Pro 48MP dengan 5x optical zoom telephoto. Garansi Resmi iBox Indonesia.',
            ],
            [
                'name' => 'Xiaomi 14 Ultra Leica Summilux Optics 16GB/512GB',
                'price' => 18999000,
                'desc' => 'Kolaborasi fotografi optik Leica dengan sensor 1-inch LYT-900. Snapdragon 8 Gen 3, baterai 5000mAh dengan 90W HyperCharge dan 80W Wireless Charging. Garansi Resmi Xiaomi Indonesia.',
            ],
            [
                'name' => 'Google Pixel 8 Pro 12GB/256GB Obsidian Black',
                'price' => 16499000,
                'desc' => 'Google Tensor G3 dengan fitur kecerdasan buatan terdepan (Best Take, Magic Editor). Layar Super Actua Display 120Hz dan kamera komputasional terbaik di kelasnya.',
            ],
            [
                'name' => 'Vivo X100 Pro 5G Zeiss APO Telephoto 16GB/512GB',
                'price' => 16999000,
                'desc' => 'Chipset MediaTek Dimensity 9300 flagship dengan sensor 1-inch Zeiss dan V3 Imaging Chip. Baterai 5400mAh 100W FlashCharge. Garansi Resmi Vivo Indonesia.',
            ],
            [
                'name' => 'ASUS ROG Phone 8 Pro Gaming Smartphone 16GB/512GB',
                'price' => 19999000,
                'desc' => 'Smartphone gaming monster Snapdragon 8 Gen 3, layar Samsung AMOLED 165Hz, pendingin GameCool 8, tombol AirTrigger kapasitif, dan AniMe Vision Mini-LED.',
            ],

            // Smartphone Mid-Range
            [
                'name' => 'Xiaomi Redmi Note 13 Pro+ 5G 12GB/512GB Midnight Black',
                'price' => 5999000,
                'desc' => 'Kamera 200MP OIS jernih dengan layar lengkung 1.5K CrystalRes AMOLED 120Hz. Dimensity 7200-Ultra, pengisian daya 120W HyperCharge, serta sertifikasi tahan air IP68.',
            ],
            [
                'name' => 'Samsung Galaxy A55 5G 8GB/256GB Awesome Iceblue',
                'price' => 6499000,
                'desc' => 'Desain premium metal frame dengan Gorilla Glass Victus+. Chipset Exynos 1480 AMD RDNA graphics, layar Super AMOLED 120Hz, dan keamanan Samsung Knox Vault.',
            ],
            [
                'name' => 'POCO X6 Pro 5G Dimensity 8300-Ultra 12GB/512GB',
                'price' => 4999000,
                'desc' => 'Performa gaming kencang skor AnTuTu 1.4 juta. Layar Flow AMOLED 120Hz, pendingin LiquidCool Technology 2.0, baterai 5000mAh dengan 67W Turbo Charge.',
            ],
            [
                'name' => 'Realme 12 Pro+ 5G Periscope Portrait Camera 12GB/512GB',
                'price' => 6999000,
                'desc' => 'Kamera telefoto periskop 64MP dengan 120x SuperZoom. Desain jam tangan mewah Luxury Watch Design, layar curved vision AMOLED 120Hz.',
            ],
            [
                'name' => 'Infinix GT 20 Pro 5G Gaming Smartphone 12GB/256GB',
                'price' => 4399000,
                'desc' => 'Didesain khusus untuk turnamen e-sports dengan MediaTek Dimensity 8200 Ultimate 4nm, dedicated gaming display chip, dan Mecha Loop LED Interface.',
            ],
            [
                'name' => 'Vivo V30 5G Aura Light Portrait 12GB/512GB Green Sea',
                'price' => 5999000,
                'desc' => 'Bodi ultra-tipis dengan baterai besar 5000mAh 80W FlashCharge. Teknologi All-New Aura Light Portrait untuk hasil foto malam hari yang natural dan estetik.',
            ],

            // Smartphone Entry-Level
            [
                'name' => 'Xiaomi Redmi 13C 8GB/256GB Baterai 5000mAh Clover Green',
                'price' => 1799000,
                'desc' => 'Layar 6.74 inci 90Hz mulus dengan kamera AI 50MP. Baterai tahan seharian 5000mAh dengan port Type-C dan memori lapang 256GB di harga terjangkau.',
            ],
            [
                'name' => 'Samsung Galaxy A15 4G Helio G99 8GB/128GB Blue Black',
                'price' => 2699000,
                'desc' => 'Layar Super AMOLED 90Hz cerah dengan Eye Comfort Shield. Performa lancar Helio G99, kamera 50MP triple sensor, dan update OS hingga 4 generasi.',
            ],
            [
                'name' => 'POCO M6 Pro 8GB/256GB Helio G99 Ultra 67W Turbo Charge',
                'price' => 2999000,
                'desc' => 'Pertama di seri M dengan layar Flow AMOLED 120Hz dan 64MP OIS Triple Camera. Pengisian daya super cepat 67W Turbo Charge.',
            ],
            [
                'name' => 'Realme C67 8GB/128GB Kamera 108MP 33W SUPERVOOC',
                'price' => 2399000,
                'desc' => 'Kamera 108MP 3x In-sensor Zoom tertipis di kelasnya. Chipset Snapdragon 685 hemat daya dan sertifikasi tahan percikan air IP54.',
            ],

            // Tablet & iPad
            [
                'name' => 'Apple iPad Air M2 11 Inch Wi-Fi 128GB Space Gray',
                'price' => 11999000,
                'desc' => 'Ditenagai chip Apple M2 super kencang untuk produktivitas grafis dan multitasking. Layar Liquid Retina True Tone, kompatibel Apple Pencil Pro dan Magic Keyboard.',
            ],
            [
                'name' => 'Samsung Galaxy Tab S9 FE 6GB/128GB with S-Pen Gray',
                'price' => 6499000,
                'desc' => 'Sudah termasuk S-Pen di dalam kotak penjualan. Layar 10.9 inci 90Hz, bodi tahan air & debu IP68, speaker stereo AKG, dan fitur Samsung DeX untuk mode PC.',
            ],
            [
                'name' => 'Xiaomi Pad 6 Snapdragon 870 8GB/256GB 144Hz WQHD+',
                'price' => 4999000,
                'desc' => 'Layar tajam 11 inci WQHD+ 144Hz 7-level variable refresh rate. Ditenagai prosesor kencang Snapdragon 870, quad stereo speaker Dolby Atmos, baterai 8840mAh.',
            ],
            [
                'name' => 'Huawei MatePad 11.5 PaperMatte Edition with Keyboard',
                'price' => 5499000,
                'desc' => 'Layar tekstur kertas PaperMatte anti-silau yang nyaman di mata untuk membaca dan menulis. Dilengkapi keyboard pintar bawaan dan Huawei M-Pencil Gen 2.',
            ],

            // Smartwatch & Wearables
            [
                'name' => 'Apple Watch Series 9 GPS 45mm Midnight Aluminum Case',
                'price' => 7499000,
                'desc' => 'Chip S9 SiP terbaru dengan gestur Double Tap inovatif. Layar Always-On Retina 2000 nits, pemantau saturasi oksigen darah, ECG, deteksi tabrakan mobil.',
            ],
            [
                'name' => 'Samsung Galaxy Watch 6 Classic 43mm Silver Rotating Bezel',
                'price' => 5499000,
                'desc' => 'Desain klasik abadi dengan bezel fisik berputar yang presisi. Layar kaca kristal Sapphire, sensor bioaktif pengukur komposisi tubuh, sleep coaching.',
            ],
            [
                'name' => 'Garmin Forerunner 265 GPS Running Smartwatch Black',
                'price' => 7999000,
                'desc' => 'Smartwatch lari dan triatlon profesional dengan layar AMOLED terang. Metrik latihan mendalam (Training Readiness, HRV Status), daya tahan baterai hingga 13 hari.',
            ],
            [
                'name' => 'Xiaomi Smart Band 8 Pro AMOLED 1.74 Inch Metallic Frame',
                'price' => 999000,
                'desc' => 'Smartband dengan layar lapang mirip smartwatch. Built-in GNSS GPS mandiri, 150+ mode olahraga, pemantau detak jantung akurat, baterai tahan 14 hari.',
            ],

            // Audio & TWS
            [
                'name' => 'Sony WH-1000XM5 Wireless Noise Cancelling Headphone',
                'price' => 4999000,
                'desc' => 'Teknologi peredam bising terbaik industri dengan 8 mikrofon dan prosesor terintegrasi V1 + QN1. Driver carbon fiber khusus, audio resolusi tinggi LDAC, baterai 30 jam.',
            ],
            [
                'name' => 'Apple AirPods Pro Gen 2 with MagSafe Case USB-C',
                'price' => 3899000,
                'desc' => 'Chip Apple H2 menghasilkan Active Noise Cancellation 2x lebih hening. Fitur Adaptive Audio, Transparansi cerdas, Audio Spasial personal, dan casing USB-C tahan air IP54.',
            ],
            [
                'name' => 'Samsung Galaxy Buds 2 Pro 24-bit Hi-Fi Audio Graphite',
                'price' => 2499000,
                'desc' => 'Kualitas audio studio 24-bit Hi-Fi audio nirkabel via Samsung Seamless Codec. Active Noise Cancellation pintar dan 360 Audio dengan Direct Multi-Channel.',
            ],
            [
                'name' => 'Marshall Minor III True Wireless Bluetooth Earbuds Black',
                'price' => 1999000,
                'desc' => 'Karakter suara khas Marshall signature sound dengan driver 12mm bertenaga. Desain ikonik tekstur kulit rock & roll, daya tahan baterai total 25 jam.',
            ],

            // Powerbank & Charger
            [
                'name' => 'Anker Prime 20000mAh 200W Output Power Bank Digital Screen',
                'price' => 1899000,
                'desc' => 'Powerbank monster berdaya total 200W mampu mengisi daya 2 laptop sekaligus secara cepat. Layar digital pintar memantau suhu, watt input, dan kapasitas real-time.',
            ],
            [
                'name' => 'Baseus GaN5 Pro 65W 3-Port Fast Charger Type-C + USB-A',
                'price' => 349000,
                'desc' => 'Kepala charger kompak teknologi Gallium Nitride generasi ke-5. Mendukung protokol PD 3.0, QC 4+, AFC, aman untuk smartphone, tablet, hingga MacBook.',
            ],
            [
                'name' => 'Ugreen Nexode 100W 4-Port GaN Desktop Fast Charger',
                'price' => 749000,
                'desc' => 'Charger serbaguna 4 port (3 USB-C + 1 USB-A) dengan total output 100W. Proteksi multi-proteksi cerdas Thermal Guard menjaga suhu perangkat tetap dingin.',
            ],

            // Casing & Aksesoris
            [
                'name' => 'Spigen Rugged Armor Case Anti Shock Carbon Fiber',
                'price' => 220000,
                'desc' => 'Perlindungan ekstra bersertifikasi Military Grade Air Cushion Technology. Bahan TPU fleksibel dengan aksen serat karbon premium yang elegan dan anti-slip.',
            ],
            [
                'name' => 'Tempered Glass Full Cover 9H Ultra Clear Scratch Proof',
                'price' => 85000,
                'desc' => 'Pelindung layar kaca tempered berkekuatan 9H tahan gores benda tajam. Lapisan oleophobic anti sidik jari dan minyak, presisi 2.5D melengkung lembut.',
            ],
            [
                'name' => 'DJI Osmo Mobile 6 Smartphone Gimbal Stabilizer Slate Gray',
                'price' => 2249000,
                'desc' => 'Stabilizer gimbal 3-sumbu lipat portabel dengan tongkat ekstensi bawaan. Pelacakan subjek cerdas ActiveTrack 6.0, peluncuran cepat, dan roda kontrol manual fokus/zoom.',
            ],
            [
                'name' => 'Baseus Magnetic Wireless Car Mount Charger 15W MagSafe',
                'price' => 299000,
                'desc' => 'Dudukan HP mobil dengan magnet kuat N52 kompatibel MagSafe iPhone dan casing magnetik. Pengisian daya nirkabel cepat 15W rotasi 360 derajat.',
            ],
        ];

        $variants = [
            'Garansi Resmi',
            'Paket Bundling Bonus Case',
            'Varian Global ROM',
            'Stok Terbatas Promo',
            'Warna Eksklusif',
        ];

        $item = fake()->randomElement($gadgets);
        $variant = fake()->randomElement($variants);

        return [
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'name' => $item['name'].' ('.$variant.')',
            'sku' => fake()->unique()->regexify('[A-Z]{3}-[0-9]{4}-[A-Z]{2}'),
            'price' => (float) $item['price'],
            'stock' => fake()->numberBetween(5, 120),
            'description' => $item['desc'],
            'discount_percentage' => fake()->randomElement([0, 0, 5, 10, 15, 20]),
            'rating' => fake()->randomFloat(1, 4.5, 5.0),
            'thumbnail' => "https://picsum.photos/640/480?random={$this->generateNumberBetween(1, 1000)}",
        ];
    }

    private function generateNumberBetween(int $min = 0, int $max = 1000): int
    {
        return fake()->numberBetween($min, $max);
    }
}
