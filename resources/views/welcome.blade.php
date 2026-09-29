<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} &mdash; Katalog Toko E-Commerce</title>

        <!-- Google Fonts: Lora (Editorial Serif), Inter (Sans), JetBrains Mono -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&family=Lora:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap" rel="stylesheet">

        <!-- Theme Initialization Script -->
        <script>
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- Scripts & Styles via Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        x-data="{
            searchQuery: '',
            selectedCategory: 'all',
            onlyInStock: false,
            sortBy: 'latest',
            activeArtifact: null,
            cartCount: 0,
            toastMessage: '',
            showToast: false,

            triggerToast(msg) {
                this.toastMessage = msg;
                this.showToast = true;
                setTimeout(() => { this.showToast = false; }, 2600);
            },

            addToBag(productName) {
                this.cartCount++;
                this.triggerToast('Berhasil menambahkan \'' + productName + '\' ke keranjang.');
            }
        }"
        class="font-sans antialiased bg-claude-canvas dark:bg-claude-canvas-dark text-claude-text-primary dark:text-claude-text-dark-primary selection:bg-claude-terracotta-subtle dark:selection:bg-claude-terracotta-dark-subtle selection:text-claude-terracotta min-h-screen flex flex-col justify-between"
    >
        <!-- Navigasi Atas & Header Utama -->
        <header class="border-b border-claude-border-default dark:border-claude-border-dark bg-claude-surface dark:bg-claude-surface-dark sticky top-0 z-30 backdrop-blur-md bg-opacity-95 dark:bg-opacity-95">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <!-- Logo & Judul Brand -->
                <div class="flex items-center gap-3">
                    <a href="/" class="flex items-center gap-3 group">
                        <div class="w-9 h-9 rounded-xl bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark flex items-center justify-center text-claude-terracotta dark:text-claude-terracotta-dark shadow-sm group-hover:scale-105 transition-transform duration-200">
                            <!-- Ikon Tas Belanja Minimalis -->
                            <svg class="w-4 h-4 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-serif text-lg font-semibold tracking-tight text-claude-text-primary dark:text-claude-text-dark-primary leading-tight">
                                Katalog Toko
                            </span>
                            <span class="text-[10px] text-claude-text-tertiary dark:text-claude-text-dark-tertiary tracking-wider uppercase font-mono">
                                E-Commerce Pilihan &bull; Edisi 11
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Navigasi Menu Tengah -->
                <nav class="hidden md:flex items-center gap-1 text-sm font-medium text-claude-text-secondary dark:text-claude-text-dark-secondary">
                    <a href="/" class="px-3 py-1.5 rounded-lg text-claude-terracotta dark:text-claude-terracotta-dark bg-claude-surface-subtle dark:bg-claude-surface-dark-subtle transition-colors">
                        Katalog
                    </a>
                    <a href="/demo/eager-loading" target="_blank" class="px-3 py-1.5 rounded-lg hover:text-claude-text-primary dark:hover:text-claude-text-dark-primary transition-colors inline-flex items-center gap-1.5">
                        <span>Uji N+1 Query</span>
                        <span class="px-1.5 py-0.2 rounded text-[10px] font-mono bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">Live</span>
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-lg hover:text-claude-text-primary dark:hover:text-claude-text-dark-primary transition-colors">
                            Dashboard
                        </a>
                        @if(Auth::user()->isAdmin() || Auth::user()->isEditor())
                            <a href="/admin" target="_blank" class="px-3 py-1.5 rounded-lg text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-900/60 hover:bg-amber-100 transition-colors">
                                Panel Admin
                            </a>
                        @endif
                    @endauth
                </nav>

                <!-- Kontrol Kanan: Keranjang, Pengalih Tema & Autentikasi -->
                <div class="flex items-center gap-2.5">
                    <!-- Tombol Keranjang Belanja -->
                    <button
                        type="button"
                        @click="triggerToast(cartCount > 0 ? 'Keranjang Anda berisi ' + cartCount + ' produk.' : 'Keranjang belanja Anda masih kosong. Silakan pilih produk di bawah ini!')"
                        class="relative p-2 rounded-xl text-claude-text-secondary dark:text-claude-text-dark-secondary hover:bg-claude-surface-subtle dark:hover:bg-claude-surface-dark-subtle border border-claude-border-default dark:border-claude-border-dark transition-colors"
                        title="Lihat Keranjang Belanja"
                    >
                        <svg class="w-4 h-4 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <span
                            x-show="cartCount > 0"
                            x-text="cartCount"
                            class="absolute -top-1.5 -right-1.5 w-4 h-4 rounded-full bg-claude-terracotta text-white font-mono text-[10px] font-bold flex items-center justify-center"
                        ></span>
                    </button>

                    <!-- Tombol Pengalih Tema Terang/Gelap -->
                    <button
                        type="button"
                        onclick="
                            const isDark = document.documentElement.classList.toggle('dark');
                            localStorage.setItem('theme', isDark ? 'dark' : 'light');
                        "
                        class="p-2 rounded-xl text-claude-text-secondary dark:text-claude-text-dark-secondary hover:bg-claude-surface-subtle dark:hover:bg-claude-surface-dark-subtle border border-claude-border-default dark:border-claude-border-dark transition-colors"
                        title="Ganti tema terang/gelap"
                    >
                        <svg class="w-4 h-4 stroke-[1.5] hidden dark:block text-amber-300" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="12" cy="12" r="4"></circle>
                            <path d="M12 2v2"></path>
                            <path d="M12 20v2"></path>
                            <path d="m4.93 4.93 1.41 1.41"></path>
                            <path d="m17.66 17.66 1.41 1.41"></path>
                            <path d="M2 12h2"></path>
                            <path d="M20 12h2"></path>
                            <path d="m6.34 17.66-1.41 1.41"></path>
                            <path d="m19.07 4.93-1.41 1.41"></path>
                        </svg>
                        <svg class="w-4 h-4 stroke-[1.5] block dark:hidden text-claude-text-secondary" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                        </svg>
                    </button>

                    @if (Route::has('login'))
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-medium bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark hover:border-claude-terracotta transition-colors shadow-sm"
                            >
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="px-3 py-1.5 rounded-xl text-xs font-medium text-claude-text-secondary dark:text-claude-text-dark-secondary hover:text-claude-text-primary dark:hover:text-claude-text-dark-primary transition-colors"
                            >
                                Masuk
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="inline-flex items-center px-3.5 py-1.5 rounded-xl text-xs font-medium bg-claude-terracotta hover:bg-claude-terracotta-hover dark:bg-claude-terracotta-dark dark:hover:bg-claude-terracotta-hover text-white transition-all shadow-sm active:scale-95"
                                >
                                    Daftar
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        <!-- Area Konten Utama -->
        <main class="flex-grow">
            <!-- Bagian Hero Editorial -->
            <section class="pt-12 pb-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-mono bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark text-claude-terracotta dark:text-claude-terracotta-dark mb-4">
                    <span>Koleksi E-Commerce Pilihan &bull; Kualitas Premium</span>
                </div>

                <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-medium tracking-tight text-claude-text-primary dark:text-claude-text-dark-primary leading-[1.15]">
                    Produk pilihan berkualitas, dirancang untuk kenyamanan Anda.
                </h1>

                <p class="mt-4 text-base sm:text-lg text-claude-text-secondary dark:text-claude-text-dark-secondary max-w-2xl mx-auto leading-relaxed">
                    Katalog kurasi berisi {{ $products->count() }} produk pilihan. Dilengkapi relasi Eloquent, sistem multi-peran yang aman, dan tanpa kendala N+1 query.
                </p>

                <!-- Kotak Pencarian & Filter Cepat -->
                <div class="mt-8 max-w-2xl mx-auto">
                    <div class="p-2 sm:p-2.5 rounded-2xl bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark shadow-claude-input focus-within:border-claude-terracotta focus-within:ring-2 focus-within:ring-claude-terracotta/20 transition-all text-left">
                        <div class="flex items-center gap-2 px-2 pt-1 pb-2">
                            <svg class="w-4 h-4 text-claude-text-tertiary stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" />
                            </svg>
                            <input
                                type="text"
                                x-model="searchQuery"
                                placeholder="Cari produk, SKU, atau kata kunci..."
                                class="w-full bg-transparent border-0 text-sm text-claude-text-primary dark:text-claude-text-dark-primary placeholder:text-claude-text-tertiary dark:placeholder:text-claude-text-dark-tertiary focus:ring-0 p-0"
                            />
                            <button
                                x-show="searchQuery.length > 0"
                                @click="searchQuery = ''"
                                class="text-xs text-claude-text-tertiary hover:text-claude-text-primary p-1"
                            >
                                Hapus
                            </button>
                        </div>

                        <!-- Baris Kontrol Filter Pencarian -->
                        <div class="flex flex-wrap items-center justify-between gap-2 pt-2 border-t border-claude-border-subtle dark:border-claude-border-dark-subtle px-1">
                            <div class="flex flex-wrap items-center gap-1.5 text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary">
                                <!-- Pilih Kategori -->
                                <select
                                    x-model="selectedCategory"
                                    class="text-xs bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark rounded-lg py-1 px-2 text-claude-text-primary dark:text-claude-text-dark-primary focus:ring-1 focus:ring-claude-terracotta"
                                >
                                    <option value="all">Semua Kategori ({{ $products->count() }})</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }} ({{ $category->products_count }})</option>
                                    @endforeach
                                </select>

                                <!-- Toggle Stok Tersedia -->
                                <button
                                    type="button"
                                    @click="onlyInStock = !onlyInStock"
                                    :class="onlyInStock ? 'bg-claude-terracotta text-white border-claude-terracotta' : 'bg-claude-surface dark:bg-claude-surface-dark border-claude-border-default dark:border-claude-border-dark text-claude-text-secondary dark:text-claude-text-dark-secondary'"
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-medium transition-colors"
                                >
                                    <span class="w-1.5 h-1.5 rounded-full" :class="onlyInStock ? 'bg-white' : 'bg-emerald-500'"></span>
                                    <span>Hanya yang Tersedia</span>
                                </button>

                                <!-- Urutkan Harga -->
                                <select
                                    x-model="sortBy"
                                    class="text-xs bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark rounded-lg py-1 px-2 text-claude-text-primary dark:text-claude-text-dark-primary focus:ring-1 focus:ring-claude-terracotta"
                                >
                                    <option value="latest">Urutkan: Terbaru</option>
                                    <option value="price-asc">Harga: Termurah</option>
                                    <option value="price-desc">Harga: Termahal</option>
                                    <option value="rating">Rating Tertinggi</option>
                                </select>
                            </div>

                            <!-- Indikator Filter -->
                            <div class="flex items-center gap-2">
                                <span class="hidden sm:inline-flex items-center gap-1 text-[11px] font-mono text-claude-text-tertiary">
                                    <span>Filter Aktif</span>
                                </span>
                                <div class="w-7 h-7 rounded-xl bg-claude-terracotta text-white flex items-center justify-center shadow-sm">
                                    <svg class="w-3.5 h-3.5 stroke-[2]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Tab Kategori Cepat -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
                <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none border-b border-claude-border-subtle dark:border-claude-border-dark-subtle">
                    <button
                        type="button"
                        @click="selectedCategory = 'all'"
                        :class="selectedCategory === 'all' ? 'border-claude-terracotta text-claude-terracotta dark:text-claude-terracotta-dark font-medium border-b-2' : 'border-transparent text-claude-text-secondary dark:text-claude-text-dark-secondary hover:text-claude-text-primary'"
                        class="px-3 py-2 text-sm whitespace-nowrap transition-colors"
                    >
                        Semua Produk ({{ $products->count() }})
                    </button>
                    @foreach($categories as $category)
                        <button
                            type="button"
                            @click="selectedCategory = '{{ $category->name }}'"
                            :class="selectedCategory === '{{ $category->name }}' ? 'border-claude-terracotta text-claude-terracotta dark:text-claude-terracotta-dark font-medium border-b-2' : 'border-transparent text-claude-text-secondary dark:text-claude-text-dark-secondary hover:text-claude-text-primary'"
                            class="px-3 py-2 text-sm whitespace-nowrap transition-colors"
                        >
                            {{ $category->name }}
                            <span class="text-xs font-mono text-claude-text-tertiary">({{ $category->products_count }})</span>
                        </button>
                    @endforeach
                </div>
            </section>

            <!-- Grid Produk Katalog -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse($products as $product)
                        <div
                            x-show="
                                (selectedCategory === 'all' || selectedCategory === '{{ $product->category->name ?? '' }}') &&
                                (!onlyInStock || {{ $product->stock }} > 0) &&
                                (searchQuery === '' || '{{ strtolower(addslashes($product->name . ' ' . $product->description . ' ' . ($product->category->name ?? ''))) }}'.includes(searchQuery.toLowerCase()))
                            "
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="group rounded-2xl bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark shadow-claude-card hover:shadow-claude-modal transition-all duration-200 flex flex-col justify-between overflow-hidden hover:border-claude-terracotta/40 dark:hover:border-claude-terracotta-dark/40"
                        >
                            <!-- Header Kartu & Kategori -->
                            <div class="p-5 pb-3">
                                <div class="flex items-start justify-between gap-2 mb-2">
                                    <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark text-claude-text-secondary dark:text-claude-text-dark-secondary">
                                        {{ $product->category->name ?? 'Produk' }}
                                    </span>

                                    @if($product->discount_percentage > 0)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-mono font-medium bg-claude-terracotta text-white shadow-sm">
                                            -{{ $product->discount_percentage }}%
                                        </span>
                                    @endif
                                </div>

                                <!-- Nama Produk -->
                                <h3 class="font-serif text-lg font-medium text-claude-text-primary dark:text-claude-text-dark-primary group-hover:text-claude-terracotta dark:group-hover:text-claude-terracotta-dark transition-colors line-clamp-2">
                                    {{ $product->name }}
                                </h3>

                                <!-- Deskripsi Ringkas -->
                                <p class="text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary mt-1.5 line-clamp-2 leading-relaxed">
                                    {{ $product->description ?? 'Produk berkualitas tinggi dengan rancangan terbaik untuk kepuasan Anda.' }}
                                </p>
                            </div>

                            <!-- Bagian Tengah: Tag, SKU & Rating -->
                            <div class="px-5 py-2">
                                <div class="flex flex-wrap gap-1 mb-3">
                                    @foreach($product->tags as $tag)
                                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated text-claude-text-tertiary dark:text-claude-text-dark-tertiary border border-claude-border-subtle dark:border-claude-border-dark-subtle">
                                            #{{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>

                                <div class="flex items-center justify-between text-xs font-mono text-claude-text-tertiary dark:text-claude-text-dark-tertiary border-t border-claude-border-subtle dark:border-claude-border-dark-subtle pt-2.5">
                                    <div class="flex items-center gap-1 text-amber-600 dark:text-amber-400 font-medium">
                                        <span>★</span>
                                        <span>{{ number_format($product->rating ?? 4.8, 1) }}</span>
                                    </div>

                                    <div>
                                        @if($product->stock > 0)
                                            <span class="text-emerald-700 dark:text-emerald-400 font-sans font-medium text-[11px] flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Tersedia ({{ $product->stock }})
                                            </span>
                                        @else
                                            <span class="text-rose-600 dark:text-rose-400 font-sans font-medium text-[11px]">
                                                Stok Habis
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Bawah Kartu: Harga & Tombol Aksi -->
                            <div class="p-5 pt-3 bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border-t border-claude-border-subtle dark:border-claude-border-dark-subtle flex items-center justify-between gap-2">
                                <div>
                                    <div class="font-serif text-lg font-medium text-claude-text-primary dark:text-claude-text-dark-primary leading-tight">
                                        Rp {{ number_format($product->final_price, 0, ',', '.') }}
                                    </div>
                                    @if($product->discount_percentage > 0)
                                        <div class="text-[11px] font-mono text-claude-text-tertiary line-through">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="flex items-center gap-1.5">
                                    <!-- Tombol Pratinjau Detail Cepat -->
                                    <button
                                        type="button"
                                        @click="activeArtifact = {
                                            id: {{ $product->id }},
                                            name: '{{ addslashes($product->name) }}',
                                            sku: '{{ $product->sku ?? 'SKU-'.$product->id }}',
                                            category: '{{ addslashes($product->category->name ?? 'Produk') }}',
                                            price: 'Rp {{ number_format($product->final_price, 0, ',', '.') }}',
                                            originalPrice: 'Rp {{ number_format($product->price, 0, ',', '.') }}',
                                            discount: {{ $product->discount_percentage ?? 0 }},
                                            stock: {{ $product->stock }},
                                            rating: {{ number_format($product->rating ?? 4.8, 1) }},
                                            description: '{{ addslashes($product->description ?? '') }}',
                                            tags: [{{ $product->tags->map(fn($t) => "'".addslashes($t->name)."'")->join(', ') }}]
                                        }"
                                        class="p-2 rounded-xl text-claude-text-secondary dark:text-claude-text-dark-secondary hover:text-claude-terracotta dark:hover:text-claude-terracotta-dark hover:bg-claude-surface dark:hover:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark transition-colors"
                                        title="Lihat Detail Produk"
                                    >
                                        <svg class="w-4 h-4 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>

                                    <!-- Tombol Tambah ke Keranjang -->
                                    <button
                                        type="button"
                                        @click="addToBag('{{ addslashes($product->name) }}')"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-medium bg-claude-terracotta hover:bg-claude-terracotta-hover dark:bg-claude-terracotta-dark dark:hover:bg-claude-terracotta-hover text-white transition-all shadow-sm active:scale-95"
                                    >
                                        <svg class="w-3.5 h-3.5 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        <span>Beli</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center">
                            <p class="font-serif text-xl text-claude-text-secondary dark:text-claude-text-dark-secondary italic">
                                Tidak ada produk yang sesuai dengan kriteria pencarian.
                            </p>
                        </div>
                    @endforelse
                </div>
            </section>
        </main>

        <!-- Panel Drawer Samping Detail Produk -->
        <div
            x-show="activeArtifact !== null"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 overflow-hidden bg-black/40 backdrop-blur-sm flex justify-end"
            style="display: none;"
        >
            <div
                @click.outside="activeArtifact = null"
                x-show="activeArtifact !== null"
                x-transition:enter="transform transition ease-out duration-300"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in duration-200"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="w-full max-w-xl h-full bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border-l border-claude-border-default dark:border-claude-border-dark shadow-2xl flex flex-col justify-between overflow-y-auto"
            >
                <!-- Header Drawer -->
                <div>
                    <div class="p-5 border-b border-claude-border-default dark:border-claude-border-default flex items-center justify-between bg-claude-surface dark:bg-claude-surface-dark">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-claude-terracotta stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                            <span class="text-xs font-mono tracking-wider uppercase text-claude-text-secondary dark:text-claude-text-dark-secondary">
                                Informasi &amp; Spesifikasi Produk
                            </span>
                        </div>
                        <button
                            type="button"
                            @click="activeArtifact = null"
                            class="p-1.5 rounded-lg text-claude-text-tertiary hover:text-claude-text-primary hover:bg-claude-surface-subtle transition-colors"
                        >
                            <svg class="w-5 h-5 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Isi Drawer: Detail Produk -->
                    <div class="p-6 sm:p-8 space-y-6">
                        <!-- Kategori & Rating -->
                        <div class="flex items-center justify-between">
                            <span
                                x-text="activeArtifact ? activeArtifact.category : ''"
                                class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark text-claude-text-secondary dark:text-claude-text-dark-secondary"
                            ></span>
                            <div class="flex items-center gap-1 text-sm font-mono text-amber-600 dark:text-amber-400 font-medium">
                                <span>★</span>
                                <span x-text="activeArtifact ? activeArtifact.rating : '5.0'"></span>
                                <span class="text-xs text-claude-text-tertiary font-sans font-normal">(Terverifikasi)</span>
                            </div>
                        </div>

                        <!-- Nama Produk -->
                        <h2
                            x-text="activeArtifact ? activeArtifact.name : ''"
                            class="font-serif text-2xl sm:text-3xl font-medium text-claude-text-primary dark:text-claude-text-dark-primary tracking-tight"
                        ></h2>

                        <!-- Bagian Harga -->
                        <div class="p-4 rounded-xl bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark flex items-center justify-between">
                            <div>
                                <span class="text-xs text-claude-text-tertiary uppercase font-mono tracking-wider">Harga Resmi</span>
                                <div class="font-serif text-2xl font-medium text-claude-text-primary dark:text-claude-text-dark-primary mt-0.5" x-text="activeArtifact ? activeArtifact.price : ''"></div>
                            </div>
                            <template x-if="activeArtifact && activeArtifact.discount > 0">
                                <span class="px-2.5 py-1 rounded-md text-xs font-mono font-medium bg-claude-terracotta text-white" x-text="'Potongan ' + activeArtifact.discount + '%'"></span>
                            </template>
                        </div>

                        <!-- Deskripsi -->
                        <div class="space-y-3">
                            <h4 class="font-serif text-sm font-semibold tracking-wide text-claude-text-primary dark:text-claude-text-dark-primary uppercase font-mono">
                                Deskripsi Produk
                            </h4>
                            <p
                                x-text="activeArtifact ? activeArtifact.description : ''"
                                class="text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary leading-relaxed font-sans"
                            ></p>
                        </div>

                        <!-- Grid Spesifikasi Teknis -->
                        <div class="space-y-3">
                            <h4 class="font-serif text-sm font-semibold tracking-wide text-claude-text-primary dark:text-claude-text-dark-primary uppercase font-mono">
                                Informasi Inventaris
                            </h4>
                            <div class="grid grid-cols-2 gap-3 text-xs font-mono">
                                <div class="p-3 rounded-lg bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-subtle dark:border-claude-border-dark-subtle">
                                    <div class="text-claude-text-tertiary">Nomor SKU</div>
                                    <div class="font-medium text-claude-text-primary dark:text-claude-text-dark-primary mt-1" x-text="activeArtifact ? activeArtifact.sku : ''"></div>
                                </div>
                                <div class="p-3 rounded-lg bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-subtle dark:border-claude-border-dark-subtle">
                                    <div class="text-claude-text-tertiary">Ketersediaan Stok</div>
                                    <div class="font-medium text-emerald-600 dark:text-emerald-400 mt-1" x-text="activeArtifact ? activeArtifact.stock + ' unit siap dikirim' : ''"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Query Representation -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs font-mono text-claude-text-tertiary">
                                <span>Representasi Query Eloquent</span>
                                <span class="text-emerald-600 dark:text-emerald-400">Eager Loaded &bull; 0 N+1</span>
                            </div>
                            <pre class="p-3.5 rounded-xl bg-claude-code-bg text-claude-code-text font-mono text-xs overflow-x-auto border border-claude-border-dark leading-relaxed"><code>Product::with(['category', 'tags'])
    ->where('id', <span x-text="activeArtifact ? activeArtifact.id : 1"></span>)
    ->firstOrFail();</code></pre>
                        </div>
                    </div>
                </div>

                <!-- Bagian Bawah Drawer -->
                <div class="p-6 border-t border-claude-border-default dark:border-claude-border-default bg-claude-surface dark:bg-claude-surface-dark flex items-center gap-3">
                    <button
                        type="button"
                        @click="addToBag(activeArtifact.name); activeArtifact = null;"
                        class="flex-1 py-3 px-4 rounded-xl text-sm font-medium bg-claude-terracotta hover:bg-claude-terracotta-hover dark:bg-claude-terracotta-dark dark:hover:bg-claude-terracotta-hover text-white transition-all shadow-sm active:scale-[0.98] text-center"
                    >
                        Tambahkan ke Keranjang Belanja
                    </button>
                    <button
                        type="button"
                        @click="activeArtifact = null"
                        class="py-3 px-4 rounded-xl text-sm font-medium bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-default text-claude-text-secondary dark:text-claude-text-dark-secondary hover:bg-claude-surface-subtle transition-colors"
                    >
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        <!-- Notifikasi Toast -->
        <div
            x-show="showToast"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            class="fixed bottom-6 right-6 z-50 bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-default text-claude-text-primary dark:text-claude-text-dark-primary px-4 py-3 rounded-2xl shadow-claude-modal flex items-center gap-3"
            style="display: none;"
        >
            <div class="w-2 h-2 rounded-full bg-claude-terracotta"></div>
            <span class="text-xs font-medium" x-text="toastMessage"></span>
        </div>

        <!-- Footer -->
        <footer class="border-t border-claude-border-default dark:border-claude-border-dark bg-claude-surface dark:bg-claude-surface-dark py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-lg bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark flex items-center justify-center text-claude-terracotta">
                        <svg class="w-3.5 h-3.5 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                    <span class="font-serif font-medium text-claude-text-primary dark:text-claude-text-dark-primary">
                        Katalog Toko
                    </span>
                    <span class="text-xs text-claude-text-tertiary font-mono">&mdash; Platform E-Commerce Pilihan</span>
                </div>

                <div class="flex flex-wrap items-center gap-6 text-xs text-claude-text-tertiary">
                    <a href="/demo/eager-loading" class="hover:text-claude-terracotta transition-colors">Uji N+1 Query</a>
                    <a href="/admin" class="hover:text-claude-terracotta transition-colors">Panel Admin</a>
                    <a href="/login" class="hover:text-claude-terracotta transition-colors">Masuk Akun</a>
                    <span>Tugas Rutin 11 &bull; Laravel 13</span>
                </div>
            </div>
        </footer>
    </body>
</html>
