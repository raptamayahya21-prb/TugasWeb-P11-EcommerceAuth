<x-guest-layout>
    <div class="mb-6">
        <h1 class="font-serif text-2xl font-medium text-claude-text-primary dark:text-claude-text-dark-primary tracking-tight">
            Sign in to your workspace
        </h1>
        <p class="text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary mt-1">
            Enter your credentials to access the editorial catalog and management panel.
        </p>
    </div>

    <!-- Quick Demo Accounts (Helper for Evaluation) -->
    <div class="mb-6 p-3 rounded-xl bg-claude-surface dark:bg-claude-surface-dark border border-claude-border-subtle dark:border-claude-border-dark-subtle" x-data>
        <div class="flex items-center justify-between mb-2">
            <span class="text-xs font-medium text-claude-text-tertiary dark:text-claude-text-dark-tertiary uppercase tracking-wider">
                Quick Test Accounts
            </span>
            <span class="text-[11px] text-claude-terracotta dark:text-claude-terracotta-dark font-medium">Click to fill</span>
        </div>
        <div class="grid grid-cols-3 gap-1.5">
            <button
                type="button"
                onclick="document.getElementById('email').value='admin@example.com';document.getElementById('password').value='password';"
                class="px-2 py-1.5 rounded-lg text-xs font-medium bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark hover:border-claude-terracotta transition-colors text-center"
            >
                👑 Admin
            </button>
            <button
                type="button"
                onclick="document.getElementById('email').value='editor@example.com';document.getElementById('password').value='password';"
                class="px-2 py-1.5 rounded-lg text-xs font-medium bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark hover:border-claude-terracotta transition-colors text-center"
            >
                ✍️ Editor
            </button>
            <button
                type="button"
                onclick="document.getElementById('email').value='user@example.com';document.getElementById('password').value='password';"
                class="px-2 py-1.5 rounded-lg text-xs font-medium bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated border border-claude-border-default dark:border-claude-border-dark hover:border-claude-terracotta transition-colors text-center"
            >
                👤 User
            </button>
        </div>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" placeholder="name@example.com" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <x-input-label for="password" :value="__('Password')" class="mb-0" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-claude-terracotta dark:text-claude-terracotta-dark hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-claude-border-default dark:border-claude-border-dark text-claude-terracotta focus:ring-claude-terracotta dark:focus:ring-claude-terracotta-dark bg-claude-surface-elevated dark:bg-claude-surface-dark-elevated" name="remember">
                <span class="ms-2 text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary">{{ __('Keep me signed in') }}</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <x-primary-button class="w-full py-3">
                {{ __('Sign In to Account') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        @if (Route::has('register'))
            <p class="text-center text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary pt-3">
                Don't have an account yet?
                <a href="{{ route('register') }}" class="text-claude-terracotta dark:text-claude-terracotta-dark font-medium hover:underline">
                    Create an account
                </a>
            </p>
        @endif
    </form>
</x-guest-layout>
