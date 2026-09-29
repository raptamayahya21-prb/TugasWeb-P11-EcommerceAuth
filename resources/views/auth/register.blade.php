<x-guest-layout>
    <div class="mb-6">
        <h1 class="font-serif text-2xl font-medium text-claude-text-primary dark:text-claude-text-dark-primary tracking-tight">
            Buat Akun Baru
        </h1>
        <p class="text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary mt-1">
            Daftar untuk mulai memesan barang dan mengelola katalog e-commerce.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Nama Lengkap -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" placeholder="Nama Anda" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <!-- Alamat Email -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" placeholder="nama@example.com" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Kata Sandi -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Konfirmasi Kata Sandi -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
            <x-text-input id="password_confirmation" class="block w-full"
                            type="password"
                            name="password_confirmation"
                            placeholder="••••••••"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <!-- Tombol Submit -->
        <div class="pt-2">
            <x-primary-button class="w-full py-3">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>

        <p class="text-center text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary pt-3">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="text-claude-terracotta dark:text-claude-terracotta-dark font-medium hover:underline">
                Masuk di sini
            </a>
        </p>
    </form>
</x-guest-layout>
