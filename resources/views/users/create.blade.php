@extends('layouts.admin')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        Tambah Pengguna
    </h1>

    <p class="mt-1 text-gray-500">
        Tambahkan pengguna baru ke sistem Stockify.
    </p>
</div>

<div class="max-w-2xl rounded-xl bg-white p-6 shadow-sm">

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        {{-- Nama --}}
        <div class="mb-5">
            <label for="name" class="mb-2 block text-sm font-medium text-gray-700">
                Nama
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                placeholder="Masukkan nama pengguna"
            >
        </div>

        {{-- Email --}}
        <div class="mb-5">
            <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                placeholder="contoh@email.com"
            >
        </div>

        {{-- Password --}}
        <div class="mb-5">
            <label for="password" class="mb-2 block text-sm font-medium text-gray-700">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                placeholder="Minimal 8 karakter"
            >
        </div>

        {{-- Role --}}
        <div class="mb-6">
            <label for="role" class="mb-2 block text-sm font-medium text-gray-700">
                Role
            </label>

            <select
                id="role"
                name="role"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >
                <option value="">-- Pilih Role --</option>

                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>

                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>
                    Manager
                </option>

                <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>
                    Staff
                </option>
            </select>
        </div>

        {{-- Tombol --}}
        <div class="flex items-center gap-3">

            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
            >
                Simpan
            </button>

            <a
                href="{{ route('users.index') }}"
                class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-300"
            >
                Batal
            </a>

        </div>

    </form>

</div>

@endsection