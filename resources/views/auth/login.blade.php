<x-guest-layout>

    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-blue-700">
            STOCKIFY
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Sistem Manajemen Stok Barang
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}">

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
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>

        <!-- Remember Me -->
        <div class="mt-4">

            <label
                for="remember_me"
                class="inline-flex items-center"
            >

                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                    name="remember"
                >

                <span class="ms-2 text-sm text-gray-600">
                    Ingat saya
                </span>

            </label>

        </div>

        <!-- Button -->
        <div class="mt-6">

            <button
                type="submit"
                class="w-full rounded-lg bg-blue-600 px-5 py-3 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
            >
                Masuk
            </button>

        </div>

    </form>

</x-guest-layout>