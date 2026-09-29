<nav x-data="{ open: false }" class="bg-claude-surface dark:bg-claude-surface-dark border-b border-claude-border-default dark:border-claude-border-dark sticky top-0 z-40 backdrop-blur-md bg-opacity-95 dark:bg-opacity-95">
    <!-- Menu Navigasi Utama -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- Logo & Judul Brand -->
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-2.5 group">
                        <div class="w-8 h-8 rounded-lg bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark flex items-center justify-center text-claude-terracotta dark:text-claude-terracotta-dark shadow-sm group-hover:scale-105 transition-transform">
                            <svg class="w-4 h-4 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <rect width="14" height="20" x="5" y="2" rx="3" ry="3"></rect>
                                <path d="M12 18h.01"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-serif text-base font-semibold tracking-tight text-claude-text-primary dark:text-claude-text-dark-primary leading-tight">
                                GadgetStore
                            </span>
                            <span class="text-[10px] text-claude-text-tertiary dark:text-claude-text-dark-tertiary tracking-wider uppercase font-mono">
                                HP &amp; Gadget
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Tautan Navigasi Desktop -->
                <div class="hidden space-x-1 sm:flex items-center">
                    <a href="/" class="px-3 py-1.5 rounded-lg text-sm font-medium transition-colors {{ request()->is('/') ? 'bg-claude-surface-subtle dark:bg-claude-surface-dark-subtle text-claude-terracotta dark:text-claude-terracotta-dark' : 'text-claude-text-secondary dark:text-claude-text-dark-secondary hover:text-claude-text-primary dark:hover:text-claude-text-dark-primary' }}">
                        Katalog
                    </a>
                    <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-claude-surface-subtle dark:bg-claude-surface-dark-subtle text-claude-terracotta dark:text-claude-terracotta-dark' : 'text-claude-text-secondary dark:text-claude-text-dark-secondary hover:text-claude-text-primary dark:hover:text-claude-text-dark-primary' }}">
                        Dashboard
                    </a>
                    <a href="/demo/eager-loading" target="_blank" class="px-3 py-1.5 rounded-lg text-sm font-medium text-claude-text-secondary dark:text-claude-text-dark-secondary hover:text-claude-text-primary dark:hover:text-claude-text-dark-primary transition-colors inline-flex items-center gap-1.5">
                        <span>Uji N+1 Query</span>
                        <svg class="w-3 h-3 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                    </a>
                    @if(Auth::user()->isAdmin() || Auth::user()->isEditor())
                        <a href="/admin" target="_blank" class="px-3 py-1.5 rounded-lg text-sm font-medium text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-900/60 hover:bg-amber-100 dark:hover:bg-amber-900/60 transition-colors inline-flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                            <span>Panel Admin</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Kontrol Kanan: Tombol Tema & Menu Akun -->
            <div class="hidden sm:flex sm:items-center sm:gap-3">
                <!-- Tombol Pengalih Tema -->
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

                <!-- Lencana Peran Akun -->
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-mono font-medium
                    @if(Auth::user()->isAdmin()) bg-rose-50 text-rose-700 border border-rose-200 dark:bg-rose-950/40 dark:text-rose-300 dark:border-rose-900/60
                    @elseif(Auth::user()->isEditor()) bg-amber-50 text-amber-700 border border-amber-200 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-900/60
                    @else bg-claude-surface-subtle text-claude-text-secondary border border-claude-border-default dark:bg-claude-surface-dark-subtle dark:text-claude-text-dark-secondary dark:border-claude-border-dark
                    @endif">
                    <span class="w-1.5 h-1.5 rounded-full
                        @if(Auth::user()->isAdmin()) bg-rose-500
                        @elseif(Auth::user()->isEditor()) bg-amber-500
                        @else bg-emerald-500
                        @endif"></span>
                    {{ ucfirst(Auth::user()->role->value ?? Auth::user()->role) }}
                </span>

                <!-- Menu Dropdown Profil -->
                <div class="relative" x-data="{ openMenu: false }">
                    <button
                        @click="openMenu = !openMenu"
                        @click.outside="openMenu = false"
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border border-claude-border-default dark:border-claude-border-dark bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated text-sm font-medium text-claude-text-primary dark:text-claude-text-dark-primary hover:bg-claude-surface-subtle dark:hover:bg-claude-surface-dark-subtle transition-colors shadow-sm"
                    >
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-3.5 h-3.5 stroke-[1.5] text-claude-text-tertiary transition-transform" :class="{ 'rotate-180': openMenu }" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <div
                        x-show="openMenu"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-52 rounded-xl bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark shadow-claude-modal py-1.5 z-50 text-sm"
                        style="display: none;"
                    >
                        <div class="px-4 py-2 border-b border-claude-border-subtle dark:border-claude-border-dark-subtle">
                            <div class="font-medium text-claude-text-primary dark:text-claude-text-dark-primary">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-claude-text-tertiary dark:text-claude-text-dark-tertiary truncate">{{ Auth::user()->email }}</div>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-claude-text-secondary dark:text-claude-text-dark-secondary hover:bg-claude-surface-subtle dark:hover:bg-claude-surface-dark-subtle hover:text-claude-text-primary dark:hover:text-claude-text-dark-primary transition-colors">
                            <svg class="w-4 h-4 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <span>Pengaturan Profil</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/30 transition-colors text-left">
                                <svg class="w-4 h-4 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                <span>Keluar (Logout)</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tombol Hamburger Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 rounded-lg text-claude-text-secondary dark:text-claude-text-dark-secondary hover:bg-claude-surface-subtle dark:hover:bg-claude-surface-dark-subtle">
                    <svg class="h-6 w-6 stroke-[1.5]" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Drawer Mobile -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden border-t border-claude-border-default dark:border-claude-border-dark bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated px-4 pt-3 pb-4 space-y-2">
        <a href="/" class="block px-3 py-2 rounded-lg text-sm font-medium text-claude-text-primary dark:text-claude-text-dark-primary hover:bg-claude-surface-subtle">
            Katalog
        </a>
        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-claude-text-primary dark:text-claude-text-dark-primary hover:bg-claude-surface-subtle">
            Dashboard
        </a>
        <a href="/demo/eager-loading" class="block px-3 py-2 rounded-lg text-sm font-medium text-claude-text-secondary dark:text-claude-text-dark-secondary hover:bg-claude-surface-subtle">
            Uji N+1 Query
        </a>
        @if(Auth::user()->isAdmin() || Auth::user()->isEditor())
            <a href="/admin" class="block px-3 py-2 rounded-lg text-sm font-medium text-amber-700 dark:text-amber-400 hover:bg-amber-50">
                Panel Admin
            </a>
        @endif
        <div class="pt-3 border-t border-claude-border-subtle dark:border-claude-border-dark-subtle flex justify-between items-center">
            <span class="text-xs font-mono text-claude-text-tertiary">{{ Auth::user()->email }} ({{ Auth::user()->role->value ?? Auth::user()->role }})</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs text-rose-600 dark:text-rose-400 font-medium">Keluar</button>
            </form>
        </div>
    </div>
</nav>
