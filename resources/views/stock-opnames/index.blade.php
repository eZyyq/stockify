
@extends('layouts.admin')

@section('content')
<style>
    /* Perbaikan ukuran ikon khusus halaman Stock Opname */
    #stock-opname-page svg {
        width: 1.5rem !important;
        height: 1.5rem !important;
        max-width: 1.5rem !important;
        max-height: 1.5rem !important;
        flex-shrink: 0;
    }

    #stock-opname-page .opname-guide-icon svg {
        width: 2rem !important;
        height: 2rem !important;
        max-width: 2rem !important;
        max-height: 2rem !important;
    }

    #stock-opname-page table {
        border-collapse: collapse;
    }
    
/* Perbaikan warna informasi produk pada mode gelap */
html.theme-dark #stock-opname-page .selected-product,
html.theme-dark #stock-opname-page .product-info,
html.theme-dark #stock-opname-page .bg-blue-50 {
    background-color: #172554 !important;
    border-color: #1e40af !important;
    color: #dbeafe !important;
}

html.theme-dark #stock-opname-page .selected-product *,
html.theme-dark #stock-opname-page .product-info *,
html.theme-dark #stock-opname-page .bg-blue-50 * {
    color: #dbeafe !important;
}

html.theme-dark #stock-opname-page input,
html.theme-dark #stock-opname-page select,
html.theme-dark #stock-opname-page textarea {
    background-color: #172033;
    color: #f3f4f6;
    border-color: #334155;
}

html.theme-dark #stock-opname-page input::placeholder,
html.theme-dark #stock-opname-page textarea::placeholder {
    color: #94a3b8;
}

html.theme-dark #stock-opname-page label {
    color: #e5e7eb;
}

/* Perbaikan notifikasi pada mode gelap */
html.theme-dark #stock-opname-page .bg-green-100,
html.theme-dark #stock-opname-page .bg-green-50 {
    background-color: #052e16 !important;
    border-color: #166534 !important;
}

html.theme-dark #stock-opname-page .text-green-700,
html.theme-dark #stock-opname-page .text-green-800,
html.theme-dark #stock-opname-page .text-green-600 {
    color: #86efac !important;
}

html.theme-dark #stock-opname-page .bg-red-100 {
    background-color: #450a0a !important;
}

html.theme-dark #stock-opname-page .text-red-700 {
    color: #fca5a5 !important;
}

html.theme-dark #stock-opname-page .bg-yellow-100 {
    background-color: #422006 !important;
}

html.theme-dark #stock-opname-page .text-yellow-700 {
    color: #fde68a !important;
}

</style>

<div id="stock-opname-page" class="mx-auto max-w-7xl space-y-6">

    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <div class="app-muted mb-2 flex items-center gap-2 text-sm">
                <span>Stockify</span>
                <span>/</span>
                <span class="font-medium text-blue-600">Stock Opname</span>
            </div>

            <h1 class="text-2xl font-extrabold tracking-tight sm:text-3xl"
                style="color:var(--text-main)">
                Stock Opname
            </h1>

            <p class="app-muted mt-2 text-sm">
                Cocokkan stok sistem dengan jumlah fisik barang di gudang.
            </p>
        </div>

        <div class="app-card flex items-center gap-3 rounded-2xl px-4 py-3">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <rect x="5" y="4" width="14" height="17" rx="2"/>
                    <path d="M9 4V2h6v2M8 10l2 2 4-4M8 16h8"/>
                </svg>
            </div>
            <div>
                <p class="app-muted text-xs">Tanggal hari ini</p>
                <p class="font-bold">{{ now()->translatedFormat('d F Y') }}</p>
            </div>
        </div>
    </div>

    {{-- PESAN SUKSES --}}
    @if(session('success'))
        <div class="flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 p-4 text-green-800">
            <span class="text-xl">✓</span>
            <div>
                <p class="font-semibold">Berhasil!</p>
                <p class="mt-1 text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- PESAN VALIDASI --}}
    @if($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-red-800">
            <p class="font-semibold">Periksa kembali data yang dimasukkan.</p>
            <ul class="mt-2 list-inside list-disc text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- RINGKASAN --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

        {{-- PRODUK TERSEDIA --}}
        <div class="app-card group relative overflow-hidden rounded-2xl border p-5 transition duration-200 hover:-translate-y-1 hover:shadow-lg"
            style="border-color:var(--line)">
            <div class="absolute inset-x-0 top-0 h-1 bg-blue-500"></div>
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                    <p class="app-muted text-sm font-medium">Produk tersedia</p>
                    <p class="mt-3 text-3xl font-extrabold tracking-tight">{{ $products->count() }}</p>
                    <p class="app-muted mt-2 text-xs">Produk untuk diperiksa</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-700 transition group-hover:scale-105">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                        <path d="M3 8v9l9 5 9-5V8M12 13v9"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- TOTAL PEMERIKSAAN --}}
        <div class="app-card group relative overflow-hidden rounded-2xl border p-5 transition duration-200 hover:-translate-y-1 hover:shadow-lg"
            style="border-color:var(--line)">
            <div class="absolute inset-x-0 top-0 h-1 bg-violet-500"></div>
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                    <p class="app-muted text-sm font-medium">Total pemeriksaan</p>
                    <p class="mt-3 text-3xl font-extrabold tracking-tight">{{ $stockOpnames->count() }}</p>
                    <p class="app-muted mt-2 text-xs">Riwayat yang ditampilkan</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-violet-100 text-violet-700 transition group-hover:scale-105">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <rect x="5" y="4" width="14" height="17" rx="2"/>
                        <path d="M9 4V2h6v2M8 10h8M8 14h8M8 18h5"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- STOK BERTAMBAH --}}
        <div class="app-card group relative overflow-hidden rounded-2xl border p-5 transition duration-200 hover:-translate-y-1 hover:shadow-lg"
            style="border-color:var(--line)">
            <div class="absolute inset-x-0 top-0 h-1 bg-emerald-500"></div>
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                    <p class="app-muted text-sm font-medium">Stok bertambah</p>
                    <p class="mt-3 text-3xl font-extrabold tracking-tight text-emerald-600">
                        +{{ $stockOpnames->where('difference', '>', 0)->sum('difference') }}
                    </p>
                    <p class="app-muted mt-2 text-xs">Selisih positif</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700 transition group-hover:scale-105">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M12 19V5M5 12l7-7 7 7"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- STOK BERKURANG --}}
        <div class="app-card group relative overflow-hidden rounded-2xl border p-5 transition duration-200 hover:-translate-y-1 hover:shadow-lg"
            style="border-color:var(--line)">
            <div class="absolute inset-x-0 top-0 h-1 bg-red-500"></div>
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                    <p class="app-muted text-sm font-medium">Stok berkurang</p>
                    <p class="mt-3 text-3xl font-extrabold tracking-tight text-red-600">
                        {{ abs(min(0, $stockOpnames->where('difference', '<', 0)->sum('difference'))) }}
                    </p>
                    <p class="app-muted mt-2 text-xs">Selisih negatif</p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-700 transition group-hover:scale-105">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M12 5v14M19 12l-7 7-7-7"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- FORM DAN PANDUAN --}}
    <div class="grid grid-cols-1 items-start gap-5 xl:grid-cols-3">

        {{-- FORM STOCK OPNAME --}}
        <section class="app-card overflow-hidden rounded-2xl xl:col-span-2">
            <div class="flex items-center gap-3 border-b p-5 sm:p-6" style="border-color:var(--line)">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-700">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold">Buat Stock Opname</h2>
                    <p class="app-muted mt-1 text-sm">Masukkan hasil penghitungan stok fisik.</p>
                </div>
            </div>

            <form action="{{ route('stock-opnames.store') }}" method="POST" class="space-y-6 p-5 sm:p-7 lg:p-8">
                @csrf

                <div>
                    <label for="product_id" class="mb-2 block text-sm font-semibold">
                        Pilih Produk <span class="text-red-500">*</span>
                    </label>
                    <select id="product_id" name="product_id" required
                        class="app-control block w-full rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                        <option value="">-- Pilih produk yang akan diperiksa --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                data-stock="{{ $product->stock }}"
                                data-name="{{ $product->name }}"
                                {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} — Stok sistem: {{ $product->stock }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="product-preview" class="hidden rounded-xl border border-blue-100 bg-blue-50 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-700">Produk dipilih</p>
                    <p id="preview-name" class="mt-1 font-bold text-blue-950"></p>
                    <p class="mt-1 text-sm text-blue-800">
                        Stok yang tercatat di sistem:
                        <strong id="preview-stock">0</strong>
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="physical_stock" class="mb-2 block text-sm font-semibold">
                            Jumlah Stok Fisik <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="physical_stock" name="physical_stock"
                            value="{{ old('physical_stock') }}" min="0" required
                            class="app-control block w-full rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                            placeholder="Contoh: 25">
                        <p class="app-muted mt-2 text-xs">Isi sesuai hasil hitung langsung di gudang.</p>
                    </div>

                    <div>
                        <label for="opname_date" class="mb-2 block text-sm font-semibold">
                            Tanggal Pemeriksaan <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="opname_date" name="opname_date"
                            value="{{ old('opname_date', date('Y-m-d')) }}" required
                            class="app-control block w-full rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    </div>
                </div>

                <div>
                    <label for="note" class="mb-2 block text-sm font-semibold">Catatan Pemeriksaan</label>
                    <textarea id="note" name="note" rows="3"
                        class="app-control block w-full rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                        placeholder="Contoh: Ada 2 barang rusak atau stok berada di rak belakang.">{{ old('note') }}</textarea>
                    <p class="app-muted mt-2 text-xs">Catatan bersifat opsional, tetapi berguna untuk menelusuri selisih.</p>
                </div>

                <div class="flex flex-col-reverse justify-between gap-4 border-t pt-6 sm:flex-row sm:items-center"
                    style="border-color:var(--line)">
                    <p class="app-muted text-xs">Pastikan produk dan jumlah stok sudah benar.</p>
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white shadow-md shadow-blue-200 transition hover:-translate-y-0.5 hover:bg-blue-800">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="m5 12 4 4L19 6"/>
                        </svg>
                        Simpan Stock Opname
                    </button>
                </div>
            </form>
        </section>

        {{-- PANDUAN --}}
        <aside class="space-y-4">
            <div class="opname-guide-icon overflow-hidden rounded-2xl bg-gradient-to-br from-blue-700 via-blue-700 to-indigo-800 p-5 text-white shadow-lg">
                <div class="mb-4 flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/15">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                        <path d="M3 8 12 3l9 5-9 5-9-5Z"/>
                        <path d="M3 8v9l9 5 9-5V8M12 13v9"/>
                        <path d="m8 8 4-2 4 2"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-blue-100">Panduan singkat</p>
                <h3 class="mt-1 text-xl font-bold">Pemeriksaan stok yang akurat</h3>
                <p class="mt-3 text-sm leading-6 text-blue-100">
                    Hitung jumlah barang secara langsung sebelum menyimpan hasil pemeriksaan.
                </p>
            </div>

            <div class="app-card rounded-2xl p-5">
                <h3 class="font-bold">Langkah pemeriksaan</h3>
                <div class="mt-4 space-y-4">
                    <div class="flex gap-3">
                        <span class="inline-flex h-8 w-8 flex-none items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-700">1</span>
                        <div>
                            <p class="text-sm font-semibold">Pilih produk</p>
                            <p class="app-muted mt-1 text-xs leading-5">Periksa nama dan stok sistem.</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <span class="inline-flex h-8 w-8 flex-none items-center justify-center rounded-full bg-violet-100 text-sm font-bold text-violet-700">2</span>
                        <div>
                            <p class="text-sm font-semibold">Hitung stok fisik</p>
                            <p class="app-muted mt-1 text-xs leading-5">Hitung barang yang benar-benar tersedia.</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <span class="inline-flex h-8 w-8 flex-none items-center justify-center rounded-full bg-green-100 text-sm font-bold text-green-700">3</span>
                        <div>
                            <p class="text-sm font-semibold">Simpan hasil</p>
                            <p class="app-muted mt-1 text-xs leading-5">Tambahkan catatan jika ditemukan selisih.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-900">
                <p class="text-sm font-bold">Tips penting</p>
                <p class="mt-1 text-xs leading-5">
                    Lakukan penghitungan dengan teliti. Jika ada selisih, catat penyebabnya agar lebih mudah ditindaklanjuti.
                </p>
            </div>
        </aside>
    </div>

    {{-- RIWAYAT STOCK OPNAME --}}
    <section class="app-card overflow-hidden rounded-2xl">
        <div class="flex flex-col justify-between gap-4 border-b p-5 sm:flex-row sm:items-center sm:p-6"
            style="border-color:var(--line)">
            <div>
                <h2 class="text-lg font-bold">Riwayat Stock Opname</h2>
                <p class="app-muted mt-1 text-sm">
                    Catatan pemeriksaan dan penyesuaian stok sebelumnya.
                </p>
            </div>

            <div class="flex items-center gap-2 rounded-lg bg-blue-50 px-3 py-2 text-sm font-medium text-blue-700">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-4-4"/>
                </svg>
                <span>{{ $stockOpnames->count() }} catatan</span>
            </div>
        </div>

        {{-- PENCARIAN --}}
        <div class="border-b p-4 sm:px-6" style="border-color:var(--line)">
            <input type="search" id="history-search"
                class="app-control block w-full rounded-xl px-4 py-3 text-sm sm:max-w-md"
                placeholder="Cari nama produk, petugas, atau catatan...">
        </div>

        {{-- TABEL RIWAYAT --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead style="background:var(--surface-soft);color:var(--text-muted)">
                    <tr>
                        <th class="whitespace-nowrap px-5 py-4 font-semibold">No.</th>
                        <th class="whitespace-nowrap px-5 py-4 font-semibold">Tanggal</th>
                        <th class="whitespace-nowrap px-5 py-4 font-semibold">Produk</th>
                        <th class="whitespace-nowrap px-5 py-4 font-semibold">Stok Sistem</th>
                        <th class="whitespace-nowrap px-5 py-4 font-semibold">Stok Fisik</th>
                        <th class="whitespace-nowrap px-5 py-4 font-semibold">Selisih</th>
                        <th class="whitespace-nowrap px-5 py-4 font-semibold">Petugas</th>
                        <th class="px-5 py-4 font-semibold">Catatan</th>
                    </tr>
                </thead>

                <tbody id="history-body">
                    @forelse($stockOpnames as $index => $opname)
                        <tr class="border-b transition hover:bg-blue-50/40"
                            style="border-color:var(--line)">
                            <td class="whitespace-nowrap px-5 py-4 app-muted">
                                {{ $index + 1 }}
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 app-muted">
                                {{ $opname->opname_date->format('d/m/Y') }}
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 font-semibold">
                                {{ $opname->product->name }}
                            </td>
                            <td class="px-5 py-4 app-muted">{{ $opname->system_stock }}</td>
                            <td class="px-5 py-4 font-semibold">{{ $opname->physical_stock }}</td>
                            <td class="whitespace-nowrap px-5 py-4">
                                @if($opname->difference > 0)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1.5 text-xs font-bold text-green-700">
                                        ↑ +{{ $opname->difference }}
                                    </span>
                                @elseif($opname->difference < 0)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-3 py-1.5 text-xs font-bold text-red-700">
                                        ↓ {{ $opname->difference }}
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-gray-100 px-3 py-1.5 text-xs font-bold text-gray-700">
                                        = 0
                                    </span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-5 py-4 app-muted">
                                {{ $opname->user->name }}
                            </td>
                            <td class="min-w-48 px-5 py-4 app-muted">
                                {{ $opname->note ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-12 text-center">
                                <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                        <rect x="5" y="4" width="14" height="17" rx="2"/>
                                        <path d="M9 4V2h6v2M8 10h8M8 14h8"/>
                                    </svg>
                                </div>
                                <p class="font-semibold">Belum ada riwayat opname</p>
                                <p class="app-muted mt-1 text-sm">
                                    Hasil pemeriksaan yang disimpan akan muncul di sini.
                                </p>
                            </td>
                        </tr>
                    @endforelse

                    <tr id="history-no-results" class="hidden">
                        <td colspan="8" class="app-muted px-5 py-8 text-center">
                            Tidak ada riwayat yang cocok dengan pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="app-muted border-t px-5 py-4 text-xs" style="border-color:var(--line)">
            Tips: gunakan pencarian untuk menemukan produk, petugas, atau catatan pemeriksaan.
        </div>
    </section>

</div>

{{-- JAVASCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const productSelect = document.getElementById('product_id');
    const preview = document.getElementById('product-preview');
    const previewName = document.getElementById('preview-name');
    const previewStock = document.getElementById('preview-stock');

    // Pratinjau produk dan stok sistem
    function updateProductPreview() {
        const option = productSelect.options[productSelect.selectedIndex];

        if (!option || !option.value) {
            preview.classList.add('hidden');
            return;
        }

        preview.classList.remove('hidden');
        previewName.textContent = option.dataset.name || option.textContent;
        previewStock.textContent = option.dataset.stock || '0';
    }

    productSelect.addEventListener('change', updateProductPreview);
    updateProductPreview();

    // Pencarian riwayat
    const searchInput = document.getElementById('history-search');
    const rows = Array.from(document.querySelectorAll('#history-body tr'))
        .filter(row => row.id !== 'history-no-results');
    const noResults = document.getElementById('history-no-results');

    searchInput.addEventListener('input', function () {
        const query = this.value.trim().toLocaleLowerCase('id');
        let visibleCount = 0;

        rows.forEach(row => {
            const matches = row.textContent.toLocaleLowerCase('id').includes(query);
            row.classList.toggle('hidden', !matches);

            if (matches) visibleCount++;
        });

        noResults.classList.toggle('hidden', visibleCount > 0);
    });
});
</script>

@endsection
