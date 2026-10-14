
@extends('layouts.admin')

@section('content')

<style>
    #categories-page .category-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
    }

    #categories-page .category-input {
        display: block;
        width: 100%;
        border: 1px solid #d1d5db;
        border-radius: .65rem;
        background: #f9fafb;
        padding: .75rem .9rem;
        color: #111827;
        font-size: .875rem;
        transition: border-color .2s, box-shadow .2s;
    }

    #categories-page .category-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .15);
    }

    #categories-page .category-label {
        display: block;
        margin-bottom: .5rem;
        color: #374151;
        font-size: .875rem;
        font-weight: 600;
    }

    #categories-page .category-table th,
    #categories-page .category-table td {
        padding: 1rem 1.25rem;
        vertical-align: middle;
    }

    #categories-page .category-table tbody tr:hover {
        background: #f8fafc;
    }

    #categories-page .category-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: .55rem;
        padding: .55rem .8rem;
        font-size: .75rem;
        font-weight: 600;
        transition: background-color .2s;
    }

    html.theme-dark #categories-page .category-card {
        background: #111827 !important;
        border-color: #374151 !important;
        color: #e5e7eb;
    }

    html.theme-dark #categories-page .text-gray-800,
    html.theme-dark #categories-page .text-gray-700,
    html.theme-dark #categories-page .text-gray-600 {
        color: #e5e7eb !important;
    }

    html.theme-dark #categories-page .text-gray-500,
    html.theme-dark #categories-page .text-gray-400 {
        color: #9ca3af !important;
    }

    html.theme-dark #categories-page .category-input {
        background: #111827 !important;
        border-color: #4b5563 !important;
        color: #f9fafb !important;
    }

    html.theme-dark #categories-page .category-input::placeholder {
        color: #9ca3af !important;
    }

    html.theme-dark #categories-page .bg-blue-50,
    html.theme-dark #categories-page .bg-gray-50 {
        background: #1f2937 !important;
    }

    html.theme-dark #categories-page .border-gray-100,
    html.theme-dark #categories-page .border-gray-200,
    html.theme-dark #categories-page .border-gray-300 {
        border-color: #374151 !important;
    }

    html.theme-dark #categories-page .category-table tbody tr,
    html.theme-dark #categories-page .category-table tbody tr.bg-white {
        background: #111827 !important;
        color: #d1d5db !important;
    }

    html.theme-dark #categories-page .category-table tbody tr:hover {
        background: #1f2937 !important;
    }

    html.theme-dark #categories-page .bg-blue-100 {
        background: #1e3a8a !important;
        color: #dbeafe !important;
    }

    html.theme-dark #categories-page .bg-green-100 {
        background: #064e3b !important;
        color: #a7f3d0 !important;
    }

    html.theme-dark #categories-page .bg-red-100 {
        background: #7f1d1d !important;
        color: #fecaca !important;
    }
    
/* Notifikasi mode gelap */
html.theme-dark #categories-page .bg-green-50 {
    background-color: #064e3b !important;
    border-color: #047857 !important;
    color: #d1fae5 !important;
}

html.theme-dark #categories-page .bg-red-50 {
    background-color: #7f1d1d !important;
    border-color: #b91c1c !important;
    color: #fee2e2 !important;
}

</style>

<div id="categories-page" class="mx-auto max-w-7xl space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm font-medium text-blue-600">
                <span>Stockify</span>
                <span class="text-gray-400">/</span>
                <span>Inventaris</span>
            </div>

            <h1 class="text-2xl font-bold tracking-tight text-gray-800 sm:text-3xl">
                Data Kategori
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Kelompokkan produk agar pengelolaan persediaan lebih teratur.
            </p>
        </div>

        <button
            type="button"
            onclick="openCategoryForm()"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
        >
            <span class="text-lg leading-none">+</span>
            Tambah Kategori
        </button>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800" role="status">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700" role="alert">
            <p class="mb-2 font-semibold">Ada data yang perlu diperiksa:</p>
            <ul class="list-inside list-disc space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- RINGKASAN --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="category-card flex items-center gap-4 p-5">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-2xl">
                🗂️
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Kategori</p>
                <p class="mt-1 text-2xl font-bold text-gray-800">
                    {{ $categories->count() }}
                </p>
                <p class="mt-1 text-xs text-gray-400">Kategori terdaftar</p>
            </div>
        </div>

        <div class="category-card flex items-center gap-4 p-5">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 text-2xl">
                ✓
            </div>
            <div>
                <p class="text-sm text-gray-500">Status Data</p>
                <p class="mt-1 text-2xl font-bold text-gray-800">
                    {{ $categories->count() > 0 ? 'Aktif' : 'Kosong' }}
                </p>
                <p class="mt-1 text-xs text-gray-400">Data kategori Stockify</p>
            </div>
        </div>
    </div>

    {{-- FORM TAMBAH KATEGORI --}}
    <div
        id="formTambahKategori"
        class="category-card overflow-hidden {{ $errors->any() ? '' : 'hidden' }}"
    >
        <div class="flex items-center justify-between gap-3 border-b border-gray-100 bg-blue-50 px-5 py-4 sm:px-6">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Tambah Kategori Baru</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Masukkan nama dan deskripsi kategori.
                </p>
            </div>

            <button
                type="button"
                onclick="closeCategoryForm()"
                class="rounded-lg px-3 py-2 text-sm text-gray-500 hover:bg-white"
                aria-label="Tutup formulir"
            >
                ✕
            </button>
        </div>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-5 p-5 sm:p-6">
            @csrf

            <div>
                <label for="category_name" class="category-label">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="category_name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    maxlength="255"
                    class="category-input"
                    placeholder="Contoh: Elektronik"
                >
            </div>

            <div>
                <label for="category_description" class="category-label">
                    Deskripsi Kategori
                </label>
                <textarea
                    id="category_description"
                    name="description"
                    rows="3"
                    class="category-input"
                    placeholder="Jelaskan kategori ini (opsional)"
                >{{ old('description') }}</textarea>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">
                <button
                    type="button"
                    onclick="closeCategoryForm()"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-blue-700"
                >
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>

    {{-- DAFTAR KATEGORI --}}
    <div class="category-card overflow-hidden">
        <div class="flex flex-col gap-4 border-b border-gray-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Daftar Kategori</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Seluruh kategori yang digunakan untuk mengelompokkan produk.
                </p>
            </div>

            <div class="w-full sm:max-w-xs">
                <label for="categorySearch" class="mb-2 block text-xs font-semibold text-gray-500">
                    Cari kategori
                </label>
                <input
                    type="search"
                    id="categorySearch"
                    class="category-input"
                    placeholder="Cari nama kategori..."
                    autocomplete="off"
                >
            </div>
        </div>

        <div class="flex items-center justify-between gap-3 bg-gray-50 px-5 py-3 text-xs text-gray-500 sm:px-6">
            <span>
                Jumlah data:
                <strong id="categoryVisibleCount" class="text-gray-700">{{ $categories->count() }}</strong>
                kategori
            </span>
            <span>Data kategori Stockify</span>
        </div>

        <div class="overflow-x-auto">
            <table class="category-table w-full text-left text-sm text-gray-600">
                
<thead class="bg-blue-700 text-xs uppercase tracking-wider text-white">
    <tr>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Deskripsi</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>


                <tbody id="categoryTableBody">
                    @forelse($categories as $category)
                        <tr
                            class="border-b border-gray-100 bg-white"
                            data-category-row
                            data-search="{{ strtolower($category->name . ' ' . ($category->description ?? '')) }}"
                        >
                            <td class="font-medium text-gray-500">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-lg">
                                        🗂️
                                    </div>
                                    <div class="font-semibold text-gray-800">
                                        {{ $category->name }}
                                    </div>
                                </div>
                            </td>

                            <td class="max-w-md whitespace-normal">
                                {{ $category->description ?: 'Belum ada deskripsi' }}
                            </td>

                            <td>
                                <span class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1.5 text-xs font-semibold text-green-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                    Terdaftar
                                </span>
                            </td>
                            
<td>
    <div class="flex items-center gap-2">
        <a
            href="{{ route('categories.edit', $category->id) }}"
            class="category-action bg-amber-100 text-amber-700 hover:bg-amber-200"
        >
            Edit
        </a>

        <form
            action="{{ route('categories.destroy', $category->id) }}"
            method="POST"
            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="category-action bg-red-100 text-red-700 hover:bg-red-200"
            >
                Hapus
            </button>
        </form>
    </div>
</td>

                        </tr>
                    @empty
                        <tr id="categoryEmptyRow">
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-3xl">
                                    🗂️
                                </div>
                                <p class="font-semibold text-gray-700">Belum ada data kategori</p>
                                <p class="mt-1 text-sm text-gray-500">
                                    Klik tombol Tambah Kategori untuk membuat kategori pertama.
                                </p>
                            </td>
                        </tr>
                    @endforelse

                    <tr id="categoryNoResults" class="hidden">
                        <td colspan="4" class="px-6 py-10 text-center">
                            <p class="font-semibold text-gray-700">Kategori tidak ditemukan</p>
                            <p class="mt-1 text-sm text-gray-500">
                                Coba kata kunci yang berbeda.
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-100 px-5 py-4 text-xs text-gray-400 sm:px-6">
            Manajemen kategori Stockify
        </div>
    </div>

</div>

<script>
    function openCategoryForm() {
        const form = document.getElementById('formTambahKategori');

        if (form) {
            form.classList.remove('hidden');
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });

            const input = document.getElementById('category_name');
            if (input) {
                setTimeout(() => input.focus(), 300);
            }
        }
    }

    function closeCategoryForm() {
        const form = document.getElementById('formTambahKategori');

        if (form) {
            form.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('categorySearch');
        const rows = Array.from(document.querySelectorAll('[data-category-row]'));
        const countElement = document.getElementById('categoryVisibleCount');
        const noResults = document.getElementById('categoryNoResults');
        const emptyRow = document.getElementById('categoryEmptyRow');

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const keyword = this.value.trim().toLowerCase();
                let visibleCount = 0;

                rows.forEach(function (row) {
                    const matches = (row.dataset.search || '').includes(keyword);

                    row.classList.toggle('hidden', !matches);

                    if (matches) {
                        visibleCount++;
                    }
                });

                if (countElement) {
                    countElement.textContent = visibleCount;
                }

                if (noResults) {
                    noResults.classList.toggle(
                        'hidden',
                        rows.length === 0 || visibleCount > 0
                    );
                }

                if (emptyRow) {
                    emptyRow.classList.toggle('hidden', keyword.length > 0);
                }
            });
        }

        const form = document.getElementById('formTambahKategori');

        if (form && !form.classList.contains('hidden')) {
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
</script>

@endsection
