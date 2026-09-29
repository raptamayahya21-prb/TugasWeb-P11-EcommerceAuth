<section class="space-y-6">
    <header>
        <h2 class="font-serif text-lg font-medium text-rose-700 dark:text-rose-400">
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary">
            Setelah akun Anda dihapus, semua sumber daya dan data di dalamnya akan dihapus secara permanen. Sebelum menghapus akun, silakan unduh data atau informasi yang ingin Anda simpan.
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >Hapus Akun Saya</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="font-serif text-lg font-medium text-claude-text-primary dark:text-claude-text-dark-primary">
                Apakah Anda yakin ingin menghapus akun Anda?
            </h2>

            <p class="mt-1 text-sm text-claude-text-secondary dark:text-claude-text-dark-secondary">
                Setelah akun Anda dihapus, seluruh data dan pesanan Anda akan dihapus secara permanen. Harap masukkan kata sandi untuk mengonfirmasi bahwa Anda benar-benar ingin menghapus akun ini.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Kata Sandi" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Masukkan Kata Sandi Anda"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>

                <x-danger-button>
                    Ya, Hapus Akun
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
