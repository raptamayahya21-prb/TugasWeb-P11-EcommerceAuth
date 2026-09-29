<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <span class="text-xs font-mono tracking-wider uppercase text-claude-terracotta dark:text-claude-terracotta-dark font-semibold">
                    Akun Pengguna
                </span>
                <h1 class="font-serif text-2xl sm:text-3xl font-medium tracking-tight text-claude-text-primary dark:text-claude-text-dark-primary mt-1">
                    Pengaturan Profil
                </h1>
            </div>
            <a href="{{ route('dashboard') }}" class="text-xs font-medium text-claude-text-secondary dark:text-claude-text-dark-secondary hover:text-claude-terracotta transition-colors flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 stroke-[1.5]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="p-6 sm:p-8 bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark rounded-2xl shadow-claude-card">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark rounded-2xl shadow-claude-card">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 sm:p-8 bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-default dark:border-claude-border-dark rounded-2xl shadow-claude-card">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
