<x-guest-layout>

    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-800">
            Reset Password
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Silakan masukkan password baru untuk akun Anda.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">

        @csrf

        <!-- Password Reset Token -->
        <input
            type="hidden"
            name="token"
            value="{{ $request->route('token') }}"
        >

        <!-- Email -->
        <div>

            <x-input-label
                for="email"
                :value="__('Email')"
            />

            <x-text-input
                id="email"
                class="mt-1 block w-full"
                type="email"
                name="email"
                :value="old('email', $request->email)"
                required
                autofocus
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
                :value="__('Password Baru')"
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

        <!-- Confirm Password -->
        <div class="mt-4">

            <x-input-label
                for="password_confirmation"
                :value="__('Konfirmasi Password Baru')"
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

        <!-- Button -->
        <div class="mt-6">

            <button
                type="submit"
                class="w-full rounded-lg bg-blue-600 px-5 py-3 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
            >
                Simpan Password Baru
            </button>

        </div>

    </form>

</x-guest-layout>