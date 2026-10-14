@extends('layouts.admin')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        Edit Pengguna
    </h1>

    <p class="mt-1 text-gray-500">
        Ubah data pengguna pada sistem Stockify.
    </p>
</div>

<div class="max-w-2xl rounded-xl bg-white p-6 shadow-sm">

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="mb-5">
            <label for="name" class="mb-2 block text-sm font-medium text-gray-700">
                Nama
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
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
                value="{{ old('email', $user->email) }}"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >
        </div>

        {{-- Password --}}
        <div class="mb-5">
            <label for="password" class="mb-2 block text-sm font-medium text-gray-700">
                Password Baru
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Kosongkan jika tidak ingin mengubah password"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >

            <p class="mt-1 text-xs text-gray-500">
                Kosongkan jika password tidak ingin diubah.
            </p>
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

                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>

                <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>
                    Manager
                </option>

                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>
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
                Simpan Perubahan
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