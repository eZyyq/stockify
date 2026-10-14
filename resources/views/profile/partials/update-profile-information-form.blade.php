<section>

    <header>
        <h2 class="text-lg font-semibold text-gray-900">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Perbarui nama dan alamat email akun Anda.
        </p>
    </header>

    {{-- Form verifikasi email --}}
    <form
        id="send-verification"
        method="post"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>

    {{-- Form update profil --}}
    <form
        method="post"
        action="{{ route('profile.update') }}"
        class="mt-6 space-y-6"
    >

        @csrf
        @method('patch')

        {{-- Nama --}}
        <div>
            <x-input-label
                for="name"
                value="Nama"
            />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label
                for="email"
                value="Email"
            />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />

            {{-- Verifikasi Email --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="mt-3 rounded-lg bg-yellow-50 p-4">

                    <p class="text-sm text-yellow-800">
                        Alamat email Anda belum diverifikasi.
                    </p>

                    <button
                        form="send-verification"
                        class="mt-2 text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline"
                    >
                        Kirim ulang email verifikasi
                    </button>

                    @if (session('status') === 'verification-link-sent')

                        <p class="mt-2 text-sm font-medium text-green-600">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </p>

                    @endif

                </div>

            @endif

        </div>

        {{-- Tombol Simpan --}}
        <div class="flex items-center gap-4">

            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
            >
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm font-medium text-green-600"
                >
                    Perubahan berhasil disimpan.
                </p>

            @endif

        </div>

    </form>

</section>