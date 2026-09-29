<x-guest-layout>
    <div class="mb-5 text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary leading-relaxed">
        Lupa kata sandi Anda? Tidak masalah. Masukkan alamat email akun Anda dan kami akan mengirimkan tautan pengaturan ulang kata sandi melalui email.
    </div>

    <!-- Status Sesi -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Alamat Email -->
        <div>
            <x-input-label for="email" value="Alamat Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-2">
            <a href="{{ route('login') }}" class="text-xs text-claude-text-secondary dark:text-claude-text-dark-secondary hover:text-claude-terracotta">
                Kembali ke halaman masuk
            </a>

            <x-primary-button>
                Kirim Tautan Reset
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
