<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} — Editorial Store</title>

        <!-- Google Fonts: Lora (Editorial Serif), Inter, JetBrains Mono -->
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

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-claude-canvas dark:bg-claude-canvas-dark text-claude-text-primary dark:text-claude-text-dark-primary selection:bg-claude-terracotta-subtle dark:selection:bg-claude-terracotta-dark-subtle selection:text-claude-terracotta">
        <div class="min-h-screen flex flex-col justify-between items-center px-4 py-8 relative">
            <!-- Top Navigation / Theme Toggle -->
            <div class="w-full max-w-md flex justify-between items-center">
                <a href="/" class="group flex items-center gap-2 text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary hover:text-claude-terracotta dark:hover:text-claude-terracotta-dark transition-colors">
                    <svg class="w-4 h-4 stroke-[1.5] transition-transform group-hover:-translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    <span>Back to catalog</span>
                </a>

                <!-- Theme Toggle Button -->
                <button
                    type="button"
                    onclick="
                        const isDark = document.documentElement.classList.toggle('dark');
                        localStorage.setItem('theme', isDark ? 'dark' : 'light');
                    "
                    class="p-2 rounded-lg text-claude-text-secondary dark:text-claude-text-dark-secondary hover:bg-claude-surface-subtle dark:hover:bg-claude-surface-dark-subtle transition-colors"
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
            </div>

            <!-- Main Auth Card Container -->
            <div class="w-full max-w-md my-auto py-8">
                <!-- Claude Editorial Emblem / Header -->
                <div class="text-center mb-6">
                    <a href="/" class="inline-flex flex-col items-center gap-2 group">
                        <div class="w-12 h-12 rounded-2xl bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark flex items-center justify-center text-claude-terracotta dark:text-claude-terracotta-dark shadow-claude-card group-hover:scale-105 transition-transform duration-200">
                            <!-- E-Commerce Store Emblem -->
                            <svg class="w-6 h-6 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                        <span class="font-serif text-xl font-medium tracking-tight text-claude-text-primary dark:text-claude-text-dark-primary mt-1">
                            L’Atelier & Co.
                        </span>
                        <span class="text-xs text-claude-text-tertiary dark:text-claude-text-dark-tertiary tracking-wide uppercase">
                            Editorial E-Commerce Catalog
                        </span>
                    </a>
                </div>

                <!-- Form Card -->
                <div class="bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark rounded-2xl shadow-claude-modal p-6 sm:p-8">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer -->
            <footer class="text-center text-xs text-claude-text-tertiary dark:text-claude-text-dark-tertiary">
                <p>Curated with warm editorial minimalism &middot; Tugas Rutin 11</p>
            </footer>
        </div>
    </body>
</html>
