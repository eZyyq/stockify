@extends('layouts.admin')

@section('content')

<div class="max-w-2xl rounded-xl bg-white p-6 shadow-sm">

    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Edit Kategori
        </h1>

        <p class="mt-1 text-gray-500">
            Ubah data kategori produk.
        </p>
    </div>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">

        @csrf
        @method('PUT')

        {{-- Nama Kategori --}}
        <div class="mb-5">

            <label
                for="name"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Nama Kategori
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $category->name) }}"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >

        </div>

        {{-- Deskripsi --}}
        <div class="mb-6">

            <label
                for="description"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Deskripsi
            </label>

            <textarea
                id="description"
                name="description"
                rows="4"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >{{ old('description', $category->description) }}</textarea>

        </div>

        {{-- Tombol --}}
        <div class="flex items-center gap-3">

            <button
                type="submit"
                class="rounded-lg bg-green-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-300"
            >
                Simpan Perubahan
            </button>

            <a
                href="{{ route('categories.index') }}"
                class="rounded-lg bg-gray-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-gray-600"
            >
                Kembali
            </a>

        </div>

    </form>

</div>

@endsection