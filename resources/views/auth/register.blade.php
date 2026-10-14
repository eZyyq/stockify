<x-guest-layout>

    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-blue-700">
            STOCKIFY
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Buat akun baru
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">

        @csrf

        <!-- Nama -->
        <div>
            <x-input-label
                for="name"
                :value="__('Nama')"
            />

            <x-text-input
                id="name"
                class="mt-1 block w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2"
            />
        </div>

        <!-- Email -->
        <div class="mt-4">

            <x-input-label
                for="email"
                :value="__('Email')"
            />

            <x-text-input
                id="email"
                class="mt-1 block w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>

        <!-- Password -->
        <div class="mt-4">

            <x-input-label
                for="password"
                :value="__('Password')"
            />

            <x-text-input
                id="password"
                class="mt-1 block w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>

        <!-- Konfirmasi Password -->
        <div class="mt-4">

            <x-input-label
                for="password_confirmation"
                :value="__('Konfirmasi Password')"
            />

            <x-text-input
                id="password_confirmation"
                class="mt-1 block w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />

        </div>

        <!-- Tombol -->
        <div class="mt-6">

            <button
                type="submit"
                class="w-full rounded-lg bg-blue-600 px-5 py-3 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
            >
                Daftar
            </button>

        </div>

        <!-- Login -->
        <div class="mt-5 text-center">

            <a
                href="{{ route('login') }}"
                class="text-sm text-blue-600 hover:text-blue-800 hover:underline"
            >
                Sudah punya akun? Masuk
            </a>

        </div>

    </form>

</x-guest-layout>