<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }} &mdash; L’Atelier & Co. Editorial Catalog</title>

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
                this.triggerToast('Added \'' + productName + '\' to your curated bag.');
            }
        }"
        class="font-sans antialiased bg-claude-canvas dark:bg-claude-canvas-dark text-claude-text-primary dark:text-claude-text-dark-primary selection:bg-claude-terracotta-subtle dark:selection:bg-claude-terracotta-dark-subtle selection:text-claude-terracotta min-h-screen flex flex-col justify-between"
    >
        <!-- Top Editorial Masthead & Navigation -->
        <header class="border-b border-claude-border-default dark:border-claude-border-dark bg-claude-surface dark:bg-claude-surface-dark sticky top-0 z-30 backdrop-blur-md bg-opacity-95 dark:bg-opacity-95">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <!-- Brand Title -->
                <div class="flex items-center gap-3">
                    <a href="/" class="flex items-center gap-3 group">
                        <div class="w-9 h-9 rounded-xl bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark flex items-center justify-center text-claude-terracotta dark:text-claude-terracotta-dark shadow-sm group-hover:scale-105 transition-transform duration-200">
                            <!-- Monogram Asterisk Emblem -->
                            <svg class="w-4 h-4 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18M5.636 5.636l12.728 12.728M5.636 18.364L18.364 5.636" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-serif text-lg font-semibold tracking-tight text-claude-text-primary dark:text-claude-text-dark-primary leading-tight">
                                L’Atelier & Co.
                            </span>
                            <span class="text-[10px] text-claude-text-tertiary dark:text-claude-text-dark-tertiary tracking-wider uppercase font-mono">
                                Editorial Catalog &bull; Vol. 11
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Center Quick Navigation / Links -->
                <nav class="hidden md:flex items-center gap-1 text-sm font-medium text-claude-text-secondary dark:text-claude-text-dark-secondary">
                    <a href="/" class="px-3 py-1.5 rounded-lg text-claude-terracotta dark:text-claude-terracotta-dark bg-claude-surface-subtle dark:bg-claude-surface-dark-subtle transition-colors">
                        Catalog
                    </a>
                    <a href="/demo/eager-loading" target="_blank" class="px-3 py-1.5 rounded-lg hover:text-claude-text-primary dark:hover:text-claude-text-dark-primary transition-colors inline-flex items-center gap-1.5">
                        <span>N+1 Benchmark</span>
                        <span class="px-1.5 py-0.2 rounded text-[10px] font-mono bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300">Live</span>
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-lg hover:text-claude-text-primary dark:hover:text-claude-text-dark-primary transition-colors">
                            Dashboard
                        </a>
                        @if(Auth::user()->isAdmin() || Auth::user()->isEditor())
                            <a href="/admin" target="_blank" class="px-3 py-1.5 rounded-lg text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-900/60 hover:bg-amber-100 transition-colors">
                                Filament Admin
                            </a>
                        @endif
                    @endauth
                </nav>

                <!-- Right Controls: Theme Toggle & Auth Actions -->
                <div class="flex items-center gap-2.5">
                    <!-- Curated Bag Button (Interactive) -->
                    <button
                        type="button"
                        @click="triggerToast(cartCount > 0 ? 'Your curated bag contains ' + cartCount + ' item(s).' : 'Your curated bag is currently empty. Explore the items below!')"
                        class="relative p-2 rounded-xl text-claude-text-secondary dark:text-claude-text-dark-secondary hover:bg-claude-surface-subtle dark:hover:bg-claude-surface-dark-subtle border border-claude-border-default dark:border-claude-border-dark transition-colors"
                        title="View Curated Bag"
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

                    <!-- Theme Toggle Button -->
                    <button
                        type="button"
                        onclick="
                            const isDark = document.documentElement.classList.toggle('dark');
                            localStorage.setItem('theme', isDark ? 'dark' : 'light');
                        "
                        class="p-2 rounded-xl text-claude-text-secondary dark:text-claude-text-dark-secondary hover:bg-claude-surface-subtle dark:hover:bg-claude-surface-dark-subtle border border-claude-border-default dark:border-claude-border-dark transition-colors"
                        title="Toggle light/dark theme"
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
                                Sign In
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="inline-flex items-center px-3.5 py-1.5 rounded-xl text-xs font-medium bg-claude-terracotta hover:bg-claude-terracotta-hover dark:bg-claude-terracotta-dark dark:hover:bg-claude-terracotta-hover text-white transition-all shadow-sm active:scale-95"
                                >
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-grow">
            <!-- Hero Editorial Section -->
            <section class="pt-12 pb-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-mono bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark text-claude-terracotta dark:text-claude-terracotta-dark mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-claude-terracotta animate-pulse"></span>
                    <span>Editorial Bookish &bull; Warm Intellectual Minimalism</span>
                </div>

                <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-medium tracking-tight text-claude-text-primary dark:text-claude-text-dark-primary leading-[1.15]">
                    Thoughtfully crafted objects, designed for quiet minds.
                </h1>

                <p class="mt-4 text-base sm:text-lg text-claude-text-secondary dark:text-claude-text-dark-secondary max-w-2xl mx-auto leading-relaxed">
                    A curated archive of {{ $products->count() }} essential goods & literature. Built with Eloquent relationships, secure multi-role auth, and zero N+1 latency.
                </p>

                <!-- Claude-style Prompt & Search Bar -->
                <div class="mt-8 max-w-2xl mx-auto">
                    <div class="p-2 sm:p-2.5 rounded-2xl bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark shadow-claude-input focus-within:border-claude-terracotta focus-within:ring-2 focus-within:ring-claude-terracotta/20 transition-all text-left">
                        <div class="flex items-center gap-2 px-2 pt-1 pb-2">
                            <svg class="w-4 h-4 text-claude-text-tertiary stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607z" />
                            </svg>
                            <input
                                type="text"
                                x-model="searchQuery"
                                placeholder="Search products, SKUs, or keywords..."
                                class="w-full bg-transparent border-0 text-sm text-claude-text-primary dark:text-claude-text-dark-primary placeholder:text-claude-text-tertiary dark:placeholder:text-claude-text-dark-tertiary focus:ring-0 p-0"
                            />
                            <button
                                x-show="searchQuery.length > 0"
                                @click="searchQuery = ''"
                                class="text-xs text-claude-text-tertiary hover:text-claude-text-primary p-1"
                            >
                                Clear
                            </button>
                        </div>

                        <!-- Prompt Bottom Controls (Claude Spec Section 7) -->
                        <div class="flex flex-wrap items-center justify-between gap-2 pt-2 border-t border-claude-border-subtle dark:border-claude-border-dark-subtle px-1">
                            <div class="flex flex-wrap items-center gap-1.5 text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary">
                                <!-- Category Select Pill -->
                                <select
                                    x-model="selectedCategory"
                                    class="text-xs bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark rounded-lg py-1 px-2 text-claude-text-primary dark:text-claude-text-dark-primary focus:ring-1 focus:ring-claude-terracotta"
                                >
                                    <option value="all">All Departments ({{ $products->count() }})</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }} ({{ $category->products_count }})</option>
                                    @endforeach
                                </select>

                                <!-- In Stock Toggle Pill -->
                                <button
                                    type="button"
                                    @click="onlyInStock = !onlyInStock"
                                    :class="onlyInStock ? 'bg-claude-terracotta text-white border-claude-terracotta' : 'bg-claude-surface dark:bg-claude-surface-dark border-claude-border-default dark:border-claude-border-dark text-claude-text-secondary dark:text-claude-text-dark-secondary'"
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-xs font-medium transition-colors"
                                >
                                    <span class="w-1.5 h-1.5 rounded-full" :class="onlyInStock ? 'bg-white' : 'bg-emerald-500'"></span>
                                    <span>In-Stock Only</span>
                                </button>

                                <!-- Price Sort Pill -->
                                <select
                                    x-model="sortBy"
                                    class="text-xs bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark rounded-lg py-1 px-2 text-claude-text-primary dark:text-claude-text-dark-primary focus:ring-1 focus:ring-claude-terracotta"
                                >
                                    <option value="latest">Sort: Latest</option>
                                    <option value="price-asc">Price: Low to High</option>
                                    <option value="price-desc">Price: High to Low</option>
                                    <option value="rating">Top Rated</option>
                                </select>
                            </div>

                            <!-- Model / Version Pill & Send Icon -->
                            <div class="flex items-center gap-2">
                                <span class="hidden sm:inline-flex items-center gap-1 text-[11px] font-mono text-claude-text-tertiary">
                                    <span>Catalog 3.7</span>
                                </span>
                                <div class="w-7 h-7 rounded-full bg-claude-terracotta text-white flex items-center justify-center shadow-sm">
                                    <svg class="w-3.5 h-3.5 stroke-[2]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Department Quick Filter Tabs -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
                <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none border-b border-claude-border-subtle dark:border-claude-border-dark-subtle">
                    <button
                        type="button"
                        @click="selectedCategory = 'all'"
                        :class="selectedCategory === 'all' ? 'border-claude-terracotta text-claude-terracotta dark:text-claude-terracotta-dark font-medium border-b-2' : 'border-transparent text-claude-text-secondary dark:text-claude-text-dark-secondary hover:text-claude-text-primary'"
                        class="px-3 py-2 text-sm whitespace-nowrap transition-colors"
                    >
                        All Items ({{ $products->count() }})
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

            <!-- Curated Products Grid -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
                <!-- Products Grid -->
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
                            <!-- Card Header & Badges -->
                            <div class="p-5 pb-3">
                                <div class="flex items-start justify-between gap-2 mb-2">
                                    <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark text-claude-text-secondary dark:text-claude-text-dark-secondary">
                                        {{ $product->category->name ?? 'Curated' }}
                                    </span>

                                    @if($product->discount_percentage > 0)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-mono font-medium bg-claude-terracotta text-white shadow-sm">
                                            -{{ $product->discount_percentage }}%
                                        </span>
                                    @endif
                                </div>

                                <!-- Product Title -->
                                <h3 class="font-serif text-lg font-medium text-claude-text-primary dark:text-claude-text-dark-primary group-hover:text-claude-terracotta dark:group-hover:text-claude-terracotta-dark transition-colors line-clamp-2">
                                    {{ $product->name }}
                                </h3>

                                <!-- Description (Bookish style) -->
                                <p class="text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary mt-1.5 line-clamp-2 leading-relaxed">
                                    {{ $product->description ?? 'An artisanally produced item designed with warm aesthetics and enduring materials.' }}
                                </p>
                            </div>

                            <!-- Middle: Metadata / SKU / Tags -->
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
                                                In Stock ({{ $product->stock }})
                                            </span>
                                        @else
                                            <span class="text-rose-600 dark:text-rose-400 font-sans font-medium text-[11px]">
                                                Sold Out
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Card Bottom: Price & Action Bar -->
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
                                    <!-- Artifact Quick-View Trigger (Claude Sidecar Panel Spec 6.3) -->
                                    <button
                                        type="button"
                                        @click="activeArtifact = {
                                            id: {{ $product->id }},
                                            name: '{{ addslashes($product->name) }}',
                                            sku: '{{ $product->sku ?? 'SKU-'.$product->id }}',
                                            category: '{{ addslashes($product->category->name ?? 'Curated') }}',
                                            price: 'Rp {{ number_format($product->final_price, 0, ',', '.') }}',
                                            originalPrice: 'Rp {{ number_format($product->price, 0, ',', '.') }}',
                                            discount: {{ $product->discount_percentage ?? 0 }},
                                            stock: {{ $product->stock }},
                                            rating: {{ number_format($product->rating ?? 4.8, 1) }},
                                            description: '{{ addslashes($product->description ?? '') }}',
                                            tags: [{{ $product->tags->map(fn($t) => "'".addslashes($t->name)."'")->join(', ') }}]
                                        }"
                                        class="p-2 rounded-xl text-claude-text-secondary dark:text-claude-text-dark-secondary hover:text-claude-terracotta dark:hover:text-claude-terracotta-dark hover:bg-claude-surface dark:hover:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark transition-colors"
                                        title="Inspect Spec Sheet (Artifact)"
                                    >
                                        <svg class="w-4 h-4 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" />
                                        </svg>
                                    </button>

                                    <!-- Add to Bag -->
                                    <button
                                        type="button"
                                        @click="addToBag('{{ addslashes($product->name) }}')"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-medium bg-claude-terracotta hover:bg-claude-terracotta-hover dark:bg-claude-terracotta-dark dark:hover:bg-claude-terracotta-hover text-white transition-all shadow-sm active:scale-95"
                                    >
                                        <svg class="w-3.5 h-3.5 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        <span>Add</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center">
                            <p class="font-serif text-xl text-claude-text-secondary dark:text-claude-text-dark-secondary italic">
                                No catalog entries match your criteria.
                            </p>
                        </div>
                    @endforelse
                </div>
            </section>
        </main>

        <!-- Claude Signature Artifact Sidecar Panel (Section 6.3 of Spec) -->
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
                <!-- Artifact Header -->
                <div>
                    <div class="p-5 border-b border-claude-border-default dark:border-claude-border-dark flex items-center justify-between bg-claude-surface dark:bg-claude-surface-dark">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-claude-terracotta animate-pulse"></span>
                            <span class="text-xs font-mono tracking-wider uppercase text-claude-text-secondary dark:text-claude-text-dark-secondary">
                                Artifact &bull; Product Specification
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

                    <!-- Artifact Body: Bookish Manuscript Presentation -->
                    <div class="p-6 sm:p-8 space-y-6">
                        <!-- Department & Rating -->
                        <div class="flex items-center justify-between">
                            <span
                                x-text="activeArtifact ? activeArtifact.category : ''"
                                class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark text-claude-text-secondary dark:text-claude-text-dark-secondary"
                            ></span>
                            <div class="flex items-center gap-1 text-sm font-mono text-amber-600 dark:text-amber-400 font-medium">
                                <span>★</span>
                                <span x-text="activeArtifact ? activeArtifact.rating : '5.0'"></span>
                                <span class="text-xs text-claude-text-tertiary font-sans font-normal">(Verified)</span>
                            </div>
                        </div>

                        <!-- Product Title -->
                        <h2
                            x-text="activeArtifact ? activeArtifact.name : ''"
                            class="font-serif text-2xl sm:text-3xl font-medium text-claude-text-primary dark:text-claude-text-dark-primary tracking-tight"
                        ></h2>

                        <!-- Price Section -->
                        <div class="p-4 rounded-xl bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark flex items-center justify-between">
                            <div>
                                <span class="text-xs text-claude-text-tertiary uppercase font-mono tracking-wider">Acquisition Price</span>
                                <div class="font-serif text-2xl font-medium text-claude-text-primary dark:text-claude-text-dark-primary mt-0.5" x-text="activeArtifact ? activeArtifact.price : ''"></div>
                            </div>
                            <template x-if="activeArtifact && activeArtifact.discount > 0">
                                <span class="px-2.5 py-1 rounded-md text-xs font-mono font-medium bg-claude-terracotta text-white" x-text="'-' + activeArtifact.discount + '% Discount Active'"></span>
                            </template>
                        </div>

                        <!-- Prose Description -->
                        <div class="space-y-3">
                            <h4 class="font-serif text-sm font-semibold tracking-wide text-claude-text-primary dark:text-claude-text-dark-primary uppercase font-mono">
                                Editorial Abstract
                            </h4>
                            <p
                                x-text="activeArtifact ? activeArtifact.description : ''"
                                class="text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary leading-relaxed font-sans"
                            ></p>
                        </div>

                        <!-- Technical Spec Grid -->
                        <div class="space-y-3">
                            <h4 class="font-serif text-sm font-semibold tracking-wide text-claude-text-primary dark:text-claude-text-dark-primary uppercase font-mono">
                                Provenance & Technical Metadata
                            </h4>
                            <div class="grid grid-cols-2 gap-3 text-xs font-mono">
                                <div class="p-3 rounded-lg bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-subtle dark:border-claude-border-dark-subtle">
                                    <div class="text-claude-text-tertiary">Inventory SKU</div>
                                    <div class="font-medium text-claude-text-primary dark:text-claude-text-dark-primary mt-1" x-text="activeArtifact ? activeArtifact.sku : ''"></div>
                                </div>
                                <div class="p-3 rounded-lg bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-subtle dark:border-claude-border-dark-subtle">
                                    <div class="text-claude-text-tertiary">Stock Status</div>
                                    <div class="font-medium text-emerald-600 dark:text-emerald-400 mt-1" x-text="activeArtifact ? activeArtifact.stock + ' units ready to ship' : ''"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Code / Query Block (Section 6.2 Code block styling) -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs font-mono text-claude-text-tertiary">
                                <span>Eloquent Query Representation</span>
                                <span class="text-emerald-600 dark:text-emerald-400">Eager Loaded &bull; 0 N+1</span>
                            </div>
                            <pre class="p-3.5 rounded-xl bg-claude-code-bg text-claude-code-text font-mono text-xs overflow-x-auto border border-claude-border-dark leading-relaxed"><code>Product::with(['category', 'tags'])
    ->where('id', <span x-text="activeArtifact ? activeArtifact.id : 1"></span>)
    ->firstOrFail();</code></pre>
                        </div>
                    </div>
                </div>

                <!-- Artifact Bottom Action Bar -->
                <div class="p-6 border-t border-claude-border-default dark:border-claude-border-dark bg-claude-surface dark:bg-claude-surface-dark flex items-center gap-3">
                    <button
                        type="button"
                        @click="addToBag(activeArtifact.name); activeArtifact = null;"
                        class="flex-1 py-3 px-4 rounded-xl text-sm font-medium bg-claude-terracotta hover:bg-claude-terracotta-hover dark:bg-claude-terracotta-dark dark:hover:bg-claude-terracotta-hover text-white transition-all shadow-sm active:scale-[0.98] text-center"
                    >
                        Acquire Object for Curated Bag
                    </button>
                    <button
                        type="button"
                        @click="activeArtifact = null"
                        class="py-3 px-4 rounded-xl text-sm font-medium bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark text-claude-text-secondary dark:text-claude-text-dark-secondary hover:bg-claude-surface-subtle transition-colors"
                    >
                        Dismiss
                    </button>
                </div>
            </div>
        </div>

        <!-- Toast Feedback Notification -->
        <div
            x-show="showToast"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            class="fixed bottom-6 right-6 z-50 bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark text-claude-text-primary dark:text-claude-text-dark-primary px-4 py-3 rounded-2xl shadow-claude-modal flex items-center gap-3"
            style="display: none;"
        >
            <div class="w-2 h-2 rounded-full bg-claude-terracotta"></div>
            <span class="text-xs font-medium" x-text="toastMessage"></span>
        </div>

        <!-- Editorial Footer -->
        <footer class="border-t border-claude-border-default dark:border-claude-border-dark bg-claude-surface dark:bg-claude-surface-dark py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-lg bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark flex items-center justify-center text-claude-terracotta">
                        <svg class="w-3.5 h-3.5 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18M5.636 5.636l12.728 12.728M5.636 18.364L18.364 5.636" />
                        </svg>
                    </div>
                    <span class="font-serif font-medium text-claude-text-primary dark:text-claude-text-dark-primary">
                        L’Atelier & Co.
                    </span>
                    <span class="text-xs text-claude-text-tertiary font-mono">&mdash; Editorial Bookish Edition</span>
                </div>

                <div class="flex flex-wrap items-center gap-6 text-xs text-claude-text-tertiary">
                    <a href="/demo/eager-loading" class="hover:text-claude-terracotta transition-colors">Eager Loading Demo</a>
                    <a href="/admin" class="hover:text-claude-terracotta transition-colors">Admin Panel</a>
                    <a href="/login" class="hover:text-claude-terracotta transition-colors">Sign In</a>
                    <span>Tugas Rutin 11 &bull; Laravel 13</span>
                </div>
            </div>
        </footer>
    </body>
</html>
