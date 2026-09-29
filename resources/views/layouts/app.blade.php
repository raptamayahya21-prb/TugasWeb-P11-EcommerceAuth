<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} &mdash; Editorial Workspace</title>

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
    <body class="font-sans antialiased bg-claude-canvas dark:bg-claude-canvas-dark text-claude-text-primary dark:text-claude-text-dark-primary selection:bg-claude-terracotta-subtle dark:selection:bg-claude-terracotta-dark-subtle selection:text-claude-terracotta min-h-screen flex flex-col justify-between">
        <div>
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-claude-surface dark:bg-claude-surface-dark border-b border-claude-border-default dark:border-claude-border-dark py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-8">
                {{ $slot }}
            </main>
        </div>

        <footer class="border-t border-claude-border-default dark:border-claude-border-dark py-6 text-center text-xs text-claude-text-tertiary dark:text-claude-text-dark-tertiary">
            <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
                <span>L’Atelier & Co. &middot; Editorial Bookish Design System</span>
                <span>Tugas Rutin 11 &mdash; E-Commerce DB & Auth</span>
            </div>
        </footer>
    </body>
</html>
