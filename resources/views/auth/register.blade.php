<x-guest-layout>
    <div class="mb-6">
        <h1 class="font-serif text-2xl font-medium text-claude-text-primary dark:text-claude-text-dark-primary tracking-tight">
            Create an account
        </h1>
        <p class="text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary mt-1">
            Join the community to order items, track purchases, and manage catalog entries.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" placeholder="Jane Doe" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" placeholder="name@example.com" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block w-full"
                            type="password"
                            name="password_confirmation"
                            placeholder="••••••••"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <x-primary-button class="w-full py-3">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <p class="text-center text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary pt-3">
            Already registered?
            <a href="{{ route('login') }}" class="text-claude-terracotta dark:text-claude-terracotta-dark font-medium hover:underline">
                Sign in here
            </a>
        </p>
    </form>
</x-guest-layout>
