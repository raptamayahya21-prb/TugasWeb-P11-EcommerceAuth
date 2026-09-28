# 📌 Roadmap Tugas Rutin 11 — E-Commerce DB + Secure Auth

Dokumen ini berisi panduan terstruktur dan daftar periksa (*checklist*) pengerjaan **Tugas Rutin 11**.

---

## 📋 Daftar Isi & Progress Tracker

- [x] **Fase 0: Inisialisasi Proyek Laravel**
- [x] **Bagian A: Database & Eloquent**
  - [x] 1. Migrations 7 Tabel E-Commerce + Foreign Key Constraints
  - [x] 2. Seeders + Factories (50+ Produk Realistis)
  - [x] 3. Model, Relationships & Minimal 1 Local Scope
  - [x] 4. Dokumentasi 5 Query Tinker (Screenshot)
- [x] **Bagian B: Auth & Security**
  - [x] 5. Install Laravel Breeze (Login/Register/Logout)
  - [x] 6. Multi-role (`admin`, `editor`, `user`) + Custom Middleware
  - [x] 7. Policy Otorisasi Edit/Delete (`PostPolicy` / `ProductPolicy`)
  - [x] 8. Route Protection + Pengujian Akses 2 Role (Incognito)
- [x] **⭐ Bonus (Opsional)**
  - [x] Install Filament Admin Panel
  - [x] Demo Eager Loading (Pencegahan Masalah N+1 Query)
- [x] **Fase Akhir: Push ke GitHub & Pengumpulan**
  - [x] Inisialisasi Git & Push ke repo `TugasWeb-P11-EcommerceAuth`

---

## 🛠️ Panduan Langkah demi Langkah

### 🚀 Fase 0: Inisialisasi Proyek Laravel
Jika proyek belum dibuat di folder ini:
1. Jalankan perintah instalasi Laravel:
   ```bash
   composer create-project laravel/laravel .
   ```
2. Buat database di MySQL (via Laragon / phpMyAdmin), contoh nama: `ecommerce_p11`.
3. Konfigurasikan file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ecommerce_p11
   DB_USERNAME=root
   DB_PASSWORD=
   ```

---

### 📦 Bagian A: Database & Eloquent

#### 1. Migrations 7 Tabel E-Commerce + Foreign Key (FK) Constraints
Rekomendasi 7 tabel yang saling terhubung:
1. **`users`** (bawaan Laravel, tambahkan kolom `role` enum: `admin`, `editor`, `user`).
2. **`categories`** (`id`, `name`, `slug`, `description`, timestamps).
3. **`products`** (`id`, `category_id` FK, `name`, `slug`, `description`, `price`, `stock`, `is_active`, timestamps).
4. **`orders`** (`id`, `user_id` FK, `order_number`, `total_price`, `status`, timestamps).
5. **`order_items`** (`id`, `order_id` FK, `product_id` FK, `quantity`, `price`, timestamps).
6. **`reviews`** (`id`, `user_id` FK, `product_id` FK, `rating`, `comment`, timestamps).
7. **`carts`** (atau `cart_items`: `id`, `user_id` FK, `product_id` FK, `quantity`, timestamps).

> **Catatan FK**: Pastikan menggunakan onDelete cascade/restrict yang rapi:
> ```php
> $table->foreignId('category_id')->constrained()->cascadeOnDelete();
> ```

#### 2. Seeders & Factories (50+ Produk Realistis)
1. Buat Factory untuk Category, Product, Review, dll:
   ```bash
   php artisan make:factory CategoryFactory
   php artisan make:factory ProductFactory
   ```
2. Buat seeder data realistis (Faker):
   - Kategori (misal: *Electronics, Fashion, Books, Home & Living*).
   - Minimal **50 produk** beragam dengan deskripsi dan harga realistis.
   - User default untuk 3 role:
     - `admin@test.com` (role: `admin`)
     - `editor@test.com` (role: `editor`)
     - `user@test.com` (role: `user`)
3. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate:fresh --seed
   ```

#### 3. Model, Relationships & Minimal 1 Scope
Definisikan relasi di Model:
- **`Category`**: `hasMany(Product::class)`
- **`Product`**: `belongsTo(Category::class)`, `hasMany(Review::class)`, `hasMany(OrderItem::class)`
- **`User`**: `hasMany(Order::class)`, `hasMany(Review::class)`
- **`Order`**: `belongsTo(User::class)`, `hasMany(OrderItem::class)`
- **`OrderItem`**: `belongsTo(Order::class)`, `belongsTo(Product::class)`
- **`Review`**: `belongsTo(User::class)`, `belongsTo(Product::class)`

Tambahkan minimal 1 Local Scope pada model `Product`:
```php
// Contoh Scope Active / In-Stock
public function scopeActive($query)
{
    return $query->where('is_active', true);
}

public function scopeInStock($query)
{
    return $query->where('stock', '>', 0);
}
```

#### 4. Dokumentasi 5 Query Tinker (Screenshot)
Buka terminal dan masuk ke Tinker:
```bash
php artisan tinker
```
Jalankan 5 query berikut lalu ambil tangkapan layar (screenshot):
1. **Query 1 (Eager Loading Produk & Kategori)**:
   ```php
   Product::with('category')->take(3)->get(['id', 'name', 'category_id', 'price']);
   ```
2. **Query 2 (Memanfaatkan Local Scope)**:
   ```php
   Product::active()->inStock()->count();
   ```
3. **Query 3 (Agregasi / withCount Relasi)**:
   ```php
   Category::withCount('products')->get(['id', 'name', 'products_count']);
   ```
4. **Query 4 (Mengambil Review & User Pembeli pada Produk)**:
   ```php
   Product::first()->reviews()->with('user:id,name')->get();
   ```
5. **Query 5 (Mengambil Riwayat Order User Beserta Detail Item)**:
   ```php
   User::where('role', 'user')->first()->orders()->with('items.product')->get();
   ```

---

### 🔐 Bagian B: Auth & Security

#### 5. Install Laravel Breeze (Login / Register / Logout)
1. Install Breeze dev package:
   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install blade
   ```
2. Build asset frontend:
   ```bash
   npm install && npm run build
   ```

#### 6. Multi-role (`admin`, `editor`, `user`) + Custom Middleware
1. Pastikan kolom `role` ada di tabel `users` (default `'user'`).
2. Buat Middleware Role:
   ```bash
   php artisan make:middleware CheckRole
   ```
3. Daftarkan alias middleware (di Laravel 11 pada `bootstrap/app.php`):
   ```php
   ->withMiddleware(function (Middleware $middleware) {
       $middleware->alias([
           'role' => \App\Http\Middleware\CheckRole::class,
       ]);
   })
   ```

#### 7. Policy Otorisasi Edit/Delete
1. Buat Policy:
   ```bash
   php artisan make:policy ProductPolicy --model=Product
   # Atau PostPolicy jika ada modul Post / artikel blog e-commerce
   php artisan make:policy PostPolicy --model=Post
   ```
2. Atur hak akses:
   - `admin`: memiliki hak penuh (bypass via `before()` method atau check role).
   - `editor`: hanya dapat membuat dan mengedit produk/post.
   - `user`: hanya dapat melihat (view), tidak dapat create/edit/delete.

#### 8. Route Protection + Pengujian Akses 2 Role (Incognito)
1. Lindungi route di `routes/web.php` dengan middleware:
   ```php
   Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
       // Route khusus admin
   });

   Route::middleware(['auth', 'role:admin,editor'])->group(function () {
       // Route manajemen produk (create/edit/delete)
   });
   ```
2. Uji coba dengan 2 jendela browser:
   - Jendela 1 (Normal): Login sebagai **Admin / Editor**.
   - Jendela 2 (Incognito): Login sebagai **User**.
   - Coba akses URL admin/manajemen menggunakan akun User -> pastikan muncul **403 Forbidden** atau dialihkan (redirect).
   - Ambil screenshot hasil pengujian sebagai bukti tugas.

---

### ⭐ Bonus (Nilai Tambah)

1. **Filament Admin Panel**:
   ```bash
   composer require filament/filament:"^3.2" -W
   php artisan filament:install --panels
   ```
   Buat Resource untuk Product dan Category.
2. **Demo Eager Loading vs Lazy Loading**:
   - Tunjukkan pencegahan masalah $N+1$ menggunakan `with()` dan dokumentasikan perbedaan jumlah query melalui Laravel Debugbar / Clockwork.
3. **Repository Name**:
   - Beri nama repository GitHub: `TugasWeb-P11-EcommerceAuth`.
