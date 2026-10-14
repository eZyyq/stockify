
@extends('layouts.admin')

@section('content')

<style>
    #suppliers-page .supplier-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
    }

    #suppliers-page .supplier-input {
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

    #suppliers-page .supplier-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .15);
    }

    #suppliers-page .supplier-label {
        display: block;
        margin-bottom: .5rem;
        color: #374151;
        font-size: .875rem;
        font-weight: 600;
    }

    #suppliers-page .supplier-table th,
    #suppliers-page .supplier-table td {
        padding: 1rem 1.25rem;
        vertical-align: middle;
    }

    #suppliers-page .supplier-table tbody tr:hover {
        background: #f8fafc;
    }

    #suppliers-page .supplier-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: .55rem;
        padding: .55rem .8rem;
        font-size: .75rem;
        font-weight: 600;
        white-space: nowrap;
        transition: background-color .2s;
    }

    #suppliers-page .supplier-action:focus-visible,
    #suppliers-page button:focus-visible {
        outline: 3px solid #93c5fd;
        outline-offset: 2px;
    }

    /* Mode gelap */
    html.theme-dark #suppliers-page .supplier-card {
        background: #111827 !important;
        border-color: #374151 !important;
        color: #e5e7eb;
    }

    html.theme-dark #suppliers-page .text-gray-800,
    html.theme-dark #suppliers-page .text-gray-700,
    html.theme-dark #suppliers-page .text-gray-600,
    html.theme-dark #suppliers-page .text-gray-900 {
        color: #e5e7eb !important;
    }

    html.theme-dark #suppliers-page .text-gray-500,
    html.theme-dark #suppliers-page .text-gray-400 {
        color: #9ca3af !important;
    }

    html.theme-dark #suppliers-page .supplier-input {
        background: #111827 !important;
        border-color: #4b5563 !important;
        color: #f9fafb !important;
    }

    html.theme-dark #suppliers-page .supplier-input::placeholder {
        color: #9ca3af !important;
    }

    html.theme-dark #suppliers-page .bg-blue-50,
    html.theme-dark #suppliers-page .bg-gray-50 {
        background: #1f2937 !important;
    }

    html.theme-dark #suppliers-page .border-gray-100,
    html.theme-dark #suppliers-page .border-gray-200,
    html.theme-dark #suppliers-page .border-gray-300 {
        border-color: #374151 !important;
    }

    html.theme-dark #suppliers-page .supplier-table tbody tr,
    html.theme-dark #suppliers-page .supplier-table tbody tr.bg-white {
        background: #111827 !important;
        color: #d1d5db !important;
    }

    html.theme-dark #suppliers-page .supplier-table tbody tr:hover {
        background: #1f2937 !important;
    }

    html.theme-dark #suppliers-page .bg-green-50 {
        background: #064e3b !important;
        border-color: #047857 !important;
        color: #d1fae5 !important;
    }

    html.theme-dark #suppliers-page .bg-red-50 {
        background: #7f1d1d !important;
        border-color: #b91c1c !important;
        color: #fee2e2 !important;
    }

    html.theme-dark #suppliers-page .bg-blue-100 {
        background: #1e3a8a !important;
        color: #dbeafe !important;
    }

    @media (max-width: 640px) {
        #suppliers-page .supplier-table th,
        #suppliers-page .supplier-table td {
            padding: .8rem;
        }
    }
</style>

<div id="suppliers-page" class="mx-auto max-w-7xl space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm font-medium text-blue-600">
                <span>Stockify</span>
                <span class="text-gray-400">/</span>
                <span>Inventaris</span>
            </div>

            <h1 class="text-2xl font-bold tracking-tight text-gray-800 sm:text-3xl">
                Data Supplier
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Kelola informasi pemasok barang untuk kebutuhan persediaan.
            </p>
        </div>

        <button
            type="button"
            onclick="openSupplierForm()"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
        >
            <span class="text-lg leading-none">+</span>
            Tambah Supplier
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
        <div class="supplier-card flex items-center gap-4 p-5">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-2xl">
                🏢
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Supplier</p>
                <p class="mt-1 text-2xl font-bold text-gray-800">
                    {{ $suppliers->count() }}
                </p>
                <p class="mt-1 text-xs text-gray-400">Supplier terdaftar</p>
            </div>
        </div>

        <div class="supplier-card flex items-center gap-4 p-5">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-2xl">
                ✉
            </div>
            <div>
                <p class="text-sm text-gray-500">Supplier dengan Email</p>
                <p class="mt-1 text-2xl font-bold text-gray-800">
                    {{ $suppliers->filter(fn ($supplier) => filled($supplier->email))->count() }}
                </p>
                <p class="mt-1 text-xs text-gray-400">Memiliki alamat email</p>
            </div>
        </div>
    </div>

    {{-- FORM TAMBAH SUPPLIER --}}
    <div
        id="formSupplier"
        class="supplier-card hidden overflow-hidden"
    >
        <div class="flex items-center justify-between gap-3 border-b border-gray-100 bg-blue-50 px-5 py-4 sm:px-6">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Tambah Supplier Baru</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Lengkapi informasi pemasok di bawah ini.
                </p>
            </div>

            <button
                type="button"
                onclick="closeSupplierForm()"
                class="rounded-lg px-3 py-2 text-sm text-gray-500 hover:bg-white"
                aria-label="Tutup formulir"
            >
                ✕
            </button>
        </div>

        <form
            action="{{ route('suppliers.store') }}"
            method="POST"
            class="space-y-5 p-5 sm:p-6"
        >
            @csrf

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="supplier_name" class="supplier-label">
                        Nama Supplier <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="supplier_name"
                        name="name"
                        value="{{ old('name') }}"
                        maxlength="255"
                        required
                        class="supplier-input"
                        placeholder="Contoh: PT Sumber Makmur"
                    >
                </div>

                <div>
                    <label for="supplier_phone" class="supplier-label">
                        Nomor Telepon
                    </label>
                    <input
                        type="text"
                        id="supplier_phone"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="supplier-input"
                        placeholder="Contoh: 08123456789"
                    >
                </div>

                <div>
                    <label for="supplier_email" class="supplier-label">
                        Email
                    </label>
                    <input
                        type="email"
                        id="supplier_email"
                        name="email"
                        value="{{ old('email') }}"
                        class="supplier-input"
                        placeholder="supplier@email.com"
                    >
                </div>

                <div>
                    <label for="supplier_address" class="supplier-label">
                        Alamat
                    </label>
                    <textarea
                        id="supplier_address"
                        name="address"
                        rows="3"
                        class="supplier-input"
                        placeholder="Masukkan alamat supplier..."
                    >{{ old('address') }}</textarea>
                </div>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">
                <button
                    type="button"
                    onclick="closeSupplierForm()"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-blue-700"
                >
                    Simpan Supplier
                </button>
            </div>
        </form>
    </div>

    {{-- TABEL SUPPLIER --}}
    <div class="supplier-card overflow-hidden">
        <div class="flex flex-col gap-4 border-b border-gray-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Daftar Supplier</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Informasi pemasok yang terdaftar di Stockify.
                </p>
            </div>

            <div class="w-full sm:max-w-sm">
                <label for="supplierSearch" class="mb-2 block text-xs font-semibold text-gray-500">
                    Cari supplier
                </label>
                <input
                    type="search"
                    id="supplierSearch"
                    class="supplier-input"
                    placeholder="Nama, telepon, email, alamat..."
                    autocomplete="off"
                >
            </div>
        </div>

        <div class="flex items-center justify-between gap-3 bg-gray-50 px-5 py-3 text-xs text-gray-500 sm:px-6">
            <span>
                Jumlah data:
                <strong id="supplierVisibleCount" class="text-gray-700">{{ $suppliers->count() }}</strong>
                supplier
            </span>
            <span>Data pemasok Stockify</span>
        </div>

        <div class="overflow-x-auto">
            <table class="supplier-table w-full text-left text-sm text-gray-600">
                <thead class="bg-blue-700 text-xs uppercase tracking-wider text-white">
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody id="supplierTableBody">
                    @forelse($suppliers as $supplier)
                        <tr
                            class="border-b border-gray-100 bg-white"
                            data-supplier-row
                            data-search="{{ strtolower($supplier->name . ' ' . ($supplier->phone ?? '') . ' ' . ($supplier->email ?? '') . ' ' . ($supplier->address ?? '')) }}"
                        >
                            <td class="font-medium text-gray-500">
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-lg">
                                        🏢
                                    </div>
                                    <div class="font-semibold text-gray-800">
                                        {{ $supplier->name }}
                                    </div>
                                </div>
                            </td>

                            <td>{{ $supplier->phone ?: '-' }}</td>

                            <td>{{ $supplier->email ?: '-' }}</td>

                            <td class="max-w-xs whitespace-normal">
                                {{ $supplier->address ?: '-' }}
                            </td>

                            <td>
                                <div class="flex items-center gap-2">
                                    <a
                                        href="{{ route('suppliers.edit', $supplier->id) }}"
                                        class="supplier-action bg-amber-100 text-amber-700 hover:bg-amber-200"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('suppliers.destroy', $supplier->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus supplier ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="supplier-action bg-red-100 text-red-700 hover:bg-red-200"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="supplierEmptyRow">
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-3xl">
                                    🏢
                                </div>
                                <p class="font-semibold text-gray-700">Belum ada data supplier</p>
                                <p class="mt-1 text-sm text-gray-500">
                                    Klik Tambah Supplier untuk mendaftarkan pemasok.
                                </p>
                            </td>
                        </tr>
                    @endforelse

                    <tr id="supplierNoResults" class="hidden">
                        <td colspan="6" class="px-6 py-10 text-center">
                            <p class="font-semibold text-gray-700">Supplier tidak ditemukan</p>
                            <p class="mt-1 text-sm text-gray-500">
                                Coba gunakan kata kunci yang berbeda.
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-100 px-5 py-4 text-xs text-gray-400 sm:px-6">
            Manajemen supplier Stockify
        </div>
    </div>

</div>

<script>
    function openSupplierForm() {
        const form = document.getElementById('formSupplier');

        if (form) {
            form.classList.remove('hidden');
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });

            const input = document.getElementById('supplier_name');
            if (input) {
                setTimeout(() => input.focus(), 300);
            }
        }
    }

    function closeSupplierForm() {
        const form = document.getElementById('formSupplier');

        if (form) {
            form.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('supplierSearch');
        const rows = Array.from(document.querySelectorAll('[data-supplier-row]'));
        const countElement = document.getElementById('supplierVisibleCount');
        const noResults = document.getElementById('supplierNoResults');
        const emptyRow = document.getElementById('supplierEmptyRow');

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

        // Jika validasi gagal, tampilkan kembali formulir.
        @if($errors->any())
            openSupplierForm();
        @endif
    });
</script>

@endsection
