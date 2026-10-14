@extends('layouts.admin')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        Edit Produk
    </h1>

    <p class="mt-1 text-gray-500">
        Ubah informasi produk pada sistem Stockify.
    </p>
</div>

<div class="max-w-2xl rounded-xl bg-white p-6 shadow-sm">

    <form
        action="{{ route('products.update', $product->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        {{-- Nama Produk --}}
        <div class="mb-5">

            <label
                for="name"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Nama Produk
            </label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $product->name) }}"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >

        </div>


        {{-- Kategori --}}
        <div class="mb-5">

            <label
                for="category_id"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Kategori
            </label>

            <select
                id="category_id"
                name="category_id"
                required
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        {{ $product->category_id == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>


        {{-- Supplier --}}
        <div class="mb-5">

            <label
                for="supplier_id"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Supplier
            </label>

            <select
                id="supplier_id"
                name="supplier_id"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >

                <option value="">
                    -- Pilih Supplier --
                </option>

                @foreach($suppliers as $supplier)

                    <option
                        value="{{ $supplier->id }}"
                        {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}
                    >
                        {{ $supplier->name }}
                    </option>

                @endforeach

            </select>

        </div>


        {{-- Deskripsi --}}
        <div class="mb-5">

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
                placeholder="Masukkan deskripsi produk"
            >{{ old('description', $product->description) }}</textarea>

        </div>


        {{-- Harga Beli --}}
        <div class="mb-5">

            <label
                for="purchase_price"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Harga Beli
            </label>

            <input
                type="number"
                id="purchase_price"
                name="purchase_price"
                value="{{ old('purchase_price', $product->purchase_price) }}"
                required
                min="0"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >

        </div>


        {{-- Harga Jual --}}
        <div class="mb-5">

            <label
                for="selling_price"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Harga Jual
            </label>

            <input
                type="number"
                id="selling_price"
                name="selling_price"
                value="{{ old('selling_price', $product->selling_price) }}"
                required
                min="0"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >

        </div>


        {{-- Stok --}}
        <div class="mb-6">

            <label
                for="stock"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Stok
            </label>

            <input
                type="number"
                id="stock"
                name="stock"
                value="{{ old('stock', $product->stock) }}"
                required
                min="0"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
            >

        </div>


        {{-- Gambar Produk --}}
        <div class="mb-6">

            <label
                for="image"
                class="mb-2 block text-sm font-medium text-gray-700"
            >
                Gambar Produk
            </label>

            {{-- Gambar Lama --}}
            @if($product->image)

                <div class="mb-4">

                    <p class="mb-2 text-sm text-gray-600">
                        Gambar Saat Ini:
                    </p>

                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="h-32 w-32 rounded-lg border border-gray-200 object-cover"
                    >

                </div>

            @else

                <p class="mb-3 text-sm text-gray-400">
                    Produk belum memiliki gambar.
                </p>

            @endif


            {{-- Upload Gambar Baru --}}
            <input
                type="file"
                id="image"
                name="image"
                accept="image/png,image/jpeg,image/jpg"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900"
            >

            <p class="mt-1 text-xs text-gray-500">
                Kosongkan jika tidak ingin mengganti gambar.
                Format: JPG, JPEG, PNG. Maksimal 2 MB.
            </p>

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
                href="{{ route('products.index') }}"
                class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-300"
            >
                Batal
            </a>

        </div>

    </form>

</div>

@endsection