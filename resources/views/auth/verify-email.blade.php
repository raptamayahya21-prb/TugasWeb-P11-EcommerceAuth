<x-guest-layout>
    <div class="mb-4 text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary leading-relaxed">
        Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan ke email Anda. Jika tidak menerima email tersebut, kami dengan senang hati akan mengirimkannya kembali.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-emerald-600 dark:text-emerald-400">
            Tautan verifikasi baru telah dikirimkan ke alamat email yang Anda berikan saat pendaftaran.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    Kirim Ulang Email Verifikasi
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary hover:text-claude-terracotta rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-claude-terracotta">
                Keluar (Logout)
            </button>
        </form>
    </div>
</x-guest-layout>
