<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-xs font-mono tracking-wider uppercase text-claude-terracotta dark:text-claude-terracotta-dark font-semibold">
                        Konsol Manajemen
                    </span>
                    <span class="text-claude-text-tertiary dark:text-claude-text-dark-tertiary">&bull;</span>
                    <span class="text-xs font-mono text-claude-text-tertiary dark:text-claude-text-dark-tertiary">
                        Peran: {{ ucfirst(Auth::user()->role->value ?? Auth::user()->role) }}
                    </span>
                </div>
                <h1 class="font-serif text-2xl sm:text-3xl font-medium tracking-tight text-claude-text-primary dark:text-claude-text-dark-primary">
                    Selamat datang kembali, {{ Auth::user()->name }}
                </h1>
            </div>

            <div class="flex items-center gap-2">
                <a
                    href="/"
                    class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-sm font-medium bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark hover:bg-claude-surface-subtle dark:hover:bg-claude-surface-dark-subtle transition-colors shadow-sm"
                >
                    <svg class="w-4 h-4 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    <span>Lihat Katalog Toko</span>
                </a>

                @if(Auth::user()->isAdmin() || Auth::user()->isEditor())
                    <a
                        href="/admin"
                        target="_blank"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium bg-claude-terracotta hover:bg-claude-terracotta-hover dark:bg-claude-terracotta-dark dark:hover:bg-claude-terracotta-hover text-white transition-all shadow-sm"
                    >
                        <svg class="w-4 h-4 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                        <span>Panel Admin (Filament)</span>
                    </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- 4 Kartu Metrik -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Kartu Total Produk -->
            <div class="p-5 rounded-2xl bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark shadow-claude-card">
                <div class="flex items-center justify-between text-claude-text-tertiary dark:text-claude-text-dark-tertiary mb-2">
                    <span class="text-xs uppercase font-medium tracking-wider">Total Produk</span>
                    <svg class="w-4 h-4 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <div class="font-serif text-3xl font-medium text-claude-text-primary dark:text-claude-text-dark-primary">
                    {{ $totalProducts ?? 0 }}
                </div>
                <div class="mt-2 text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary">
                    Tersimpan di database
                </div>
            </div>

            <!-- Kartu Kategori -->
            <div class="p-5 rounded-2xl bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark shadow-claude-card">
                <div class="flex items-center justify-between text-claude-text-tertiary dark:text-claude-text-dark-tertiary mb-2">
                    <span class="text-xs uppercase font-medium tracking-wider">Kategori</span>
                    <svg class="w-4 h-4 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                </div>
                <div class="font-serif text-3xl font-medium text-claude-text-primary dark:text-claude-text-dark-primary">
                    {{ $totalCategories ?? 0 }}
                </div>
                <div class="mt-2 text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary">
                    Kategori aktif
                </div>
            </div>

            <!-- Kartu Stok Tersedia -->
            <div class="p-5 rounded-2xl bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark shadow-claude-card">
                <div class="flex items-center justify-between text-claude-text-tertiary dark:text-claude-text-dark-tertiary mb-2">
                    <span class="text-xs uppercase font-medium tracking-wider">Stok Tersedia</span>
                    <svg class="w-4 h-4 stroke-[1.5] text-emerald-600 dark:text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="font-serif text-3xl font-medium text-emerald-700 dark:text-emerald-400">
                    {{ $inStockProducts ?? 0 }}
                </div>
                <div class="mt-2 text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary">
                    Siap dipesan
                </div>
            </div>

            <!-- Kartu Diskon -->
            <div class="p-5 rounded-2xl bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark shadow-claude-card">
                <div class="flex items-center justify-between text-claude-text-tertiary dark:text-claude-text-dark-tertiary mb-2">
                    <span class="text-xs uppercase font-medium tracking-wider">Sedang Promo</span>
                    <svg class="w-4 h-4 stroke-[1.5] text-claude-terracotta dark:text-claude-terracotta-dark" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                    </svg>
                </div>
                <div class="font-serif text-3xl font-medium text-claude-terracotta dark:text-claude-terracotta-dark">
                    {{ $discountedProducts ?? 0 }}
                </div>
                <div class="mt-2 text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary">
                    Produk dengan potongan harga
                </div>
            </div>
        </div>

        <!-- Banner Verifikasi Teknis Eager Loading -->
        <div class="p-6 rounded-2xl bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark shadow-claude-card flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 rounded text-[11px] font-mono font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">
                        Pencegahan N+1 Aktif
                    </span>
                    <span class="text-xs text-claude-text-tertiary font-mono">with(['category', 'tags'])</span>
                </div>
                <h3 class="font-serif text-lg font-medium text-claude-text-primary dark:text-claude-text-dark-primary">
                    Demonstrasi Optimasi Query Eager Loading
                </h3>
                <p class="text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary max-w-2xl">
                    Sistem ini mengimplementasikan pemuatan relasi eager loading untuk mencegah bottleneck N+1 query pada data produk, kategori, dan tags.
                </p>
            </div>
            <a
                href="/demo/eager-loading"
                target="_blank"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-mono font-medium bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark hover:border-claude-terracotta dark:hover:border-claude-terracotta-dark transition-colors shrink-0"
            >
                <span>Uji Live Benchmark Query</span>
                <svg class="w-3.5 h-3.5 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>
            </a>
        </div>

        <!-- Tabel Produk Terbaru -->
        <div class="rounded-2xl bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark shadow-claude-card overflow-hidden">
            <div class="p-6 border-b border-claude-border-subtle dark:border-claude-border-dark-subtle flex items-center justify-between">
                <div>
                    <h2 class="font-serif text-xl font-medium text-claude-text-primary dark:text-claude-text-dark-primary">
                        Daftar Produk Terbaru
                    </h2>
                    <p class="text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary mt-0.5">
                        Menampilkan produk aktif terkini yang dimuat dengan relasi Eloquent
                    </p>
                </div>
                <a href="/" class="text-xs font-medium text-claude-terracotta dark:text-claude-terracotta-dark hover:underline flex items-center gap-1">
                    <span>Lihat semua produk</span>
                    <svg class="w-3 h-3 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-claude-surface dark:bg-claude-surface-dark border-b border-claude-border-subtle dark:border-claude-border-dark-subtle text-xs uppercase font-medium text-claude-text-tertiary dark:text-claude-text-dark-tertiary tracking-wider font-mono">
                        <tr>
                            <th class="px-6 py-3.5">Produk</th>
                            <th class="px-6 py-3.5">Kategori</th>
                            <th class="px-6 py-3.5">Harga</th>
                            <th class="px-6 py-3.5">Stok</th>
                            <th class="px-6 py-3.5">Rating</th>
                            <th class="px-6 py-3.5">Tag</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-claude-border-subtle dark:divide-claude-border-dark-subtle font-sans">
                        @forelse($recentProducts as $product)
                            <tr class="hover:bg-claude-surface/60 dark:hover:bg-claude-surface-dark/60 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-claude-text-primary dark:text-claude-text-dark-primary">
                                        {{ $product->name }}
                                    </div>
                                    <div class="text-xs font-mono text-claude-text-tertiary dark:text-claude-text-dark-tertiary">
                                        SKU: {{ $product->sku ?? 'N/A' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-claude-text-secondary dark:text-claude-text-dark-secondary">
                                    <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark">
                                        {{ $product->category->name ?? 'Tanpa Kategori' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-claude-text-primary dark:text-claude-text-dark-primary font-mono text-xs">
                                        Rp {{ number_format($product->final_price, 0, ',', '.') }}
                                    </div>
                                    @if($product->discount_percentage > 0)
                                        <div class="text-[11px] text-claude-terracotta dark:text-claude-terracotta-dark font-mono">
                                            -{{ $product->discount_percentage }}% diskon
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($product->stock > 10)
                                        <span class="inline-flex items-center gap-1.5 text-xs text-emerald-700 dark:text-emerald-400 font-medium">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            {{ $product->stock }} unit
                                        </span>
                                    @elseif($product->stock > 0)
                                        <span class="inline-flex items-center gap-1.5 text-xs text-amber-700 dark:text-amber-400 font-medium">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Sisa {{ $product->stock }} unit
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-xs text-rose-700 dark:text-rose-400 font-medium">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                            Stok Habis
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="inline-flex items-center gap-1 text-xs font-mono font-medium text-amber-600 dark:text-amber-400">
                                        <span>★</span>
                                        <span>{{ number_format($product->rating ?? 0, 1) }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @forelse($product->tags as $tag)
                                            <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-subtle dark:border-claude-border-dark-subtle text-claude-text-tertiary">
                                                #{{ $tag->name }}
                                            </span>
                                        @empty
                                            <span class="text-xs text-claude-text-tertiary italic">-</span>
                                        @endforelse
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-claude-text-tertiary dark:text-claude-text-dark-tertiary italic">
                                    Belum ada data produk di database.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
