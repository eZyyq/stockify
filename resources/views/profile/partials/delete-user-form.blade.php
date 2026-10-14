<section class="space-y-6">

    <header>
        <h2 class="text-lg font-semibold text-red-700">
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Setelah akun dihapus, seluruh data akun akan dihapus secara permanen.
            Pastikan Anda sudah menyimpan data penting sebelum melanjutkan.
        </p>
    </header>

    {{-- Tombol Hapus --}}
    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300"
    >
        Hapus Akun
    </button>

    {{-- Modal Konfirmasi --}}
    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >

        <form
            method="post"
            action="{{ route('profile.destroy') }}"
            class="p-6"
        >

            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900">
                Apakah Anda yakin ingin menghapus akun?
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                Tindakan ini akan menghapus akun dan seluruh data yang terkait
                secara permanen. Masukkan password Anda untuk mengonfirmasi.
            </p>

            {{-- Password --}}
            <div class="mt-6">

                <x-input-label
                    for="password"
                    value="Password"
                    class="sr-only"
                />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="Masukkan password"
                />

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2"
                />

            </div>

            {{-- Tombol Modal --}}
            <div class="mt-6 flex justify-end gap-3">

                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-300"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300"
                >
                    Hapus Akun
                </button>

            </div>

        </form>

    </x-modal>

</section>