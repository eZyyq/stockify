<section>

    <header>
        <h2 class="text-lg font-semibold text-gray-900">
            Ubah Password
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Gunakan password yang kuat untuk menjaga keamanan akun Anda.
        </p>
    </header>

    <form
        method="post"
        action="{{ route('password.update') }}"
        class="mt-6 space-y-6"
    >

        @csrf
        @method('put')

        {{-- Password Saat Ini --}}
        <div>
            <x-input-label
                for="update_password_current_password"
                value="Password Saat Ini"
            />

            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-1 block w-full"
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2"
            />
        </div>

        {{-- Password Baru --}}
        <div>
            <x-input-label
                for="update_password_password"
                value="Password Baru"
            />

            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2"
            />
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <x-input-label
                for="update_password_password_confirmation"
                value="Konfirmasi Password Baru"
            />

            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2"
            />
        </div>

        {{-- Tombol --}}
        <div class="flex items-center gap-4">

            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
            >
                Simpan Password
            </button>

            @if (session('status') === 'password-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-green-600"
                >
                    Password berhasil diperbarui.
                </p>

            @endif

        </div>

    </form>

</section>