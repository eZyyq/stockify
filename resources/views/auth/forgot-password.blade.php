<x-guest-layout>

    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-800">
            Lupa Password?
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Masukkan email akun Anda untuk mendapatkan
            link reset password.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('password.email') }}">

        @csrf

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
                :value="old('email')"
                required
                autofocus
                autocomplete="email"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>

        <!-- Button -->
        <div class="mt-6">

            <button
                type="submit"
                class="w-full rounded-lg bg-blue-600 px-5 py-3 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
            >
                Kirim Link Reset Password
            </button>

        </div>

        <!-- Back to Login -->
        <div class="mt-5 text-center">

            <a
                href="{{ route('login') }}"
                class="text-sm text-blue-600 hover:text-blue-800 hover:underline"
            >
                Kembali ke Login
            </a>

        </div>

    </form>

</x-guest-layout>