


<?php $__env->startSection('content'); ?>

<style>
    #transactions-page .transaction-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
    }

    #transactions-page .transaction-input {
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

    #transactions-page .transaction-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .15);
    }

    #transactions-page .transaction-label {
        display: block;
        margin-bottom: .5rem;
        color: #374151;
        font-size: .875rem;
        font-weight: 600;
    }

    #transactions-page .transaction-table th,
    #transactions-page .transaction-table td {
        padding: 1rem 1.25rem;
        vertical-align: middle;
    }

    #transactions-page .transaction-table tbody tr:hover {
        background: #f8fafc;
    }

    #transactions-page .transaction-action {
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

    #transactions-page .transaction-action:focus-visible,
    #transactions-page button:focus-visible {
        outline: 3px solid #93c5fd;
        outline-offset: 2px;
    }

    /* Mode gelap */
    html.theme-dark #transactions-page .transaction-card {
        background: #111827 !important;
        border-color: #374151 !important;
        color: #e5e7eb;
    }

    html.theme-dark #transactions-page .text-gray-900,
    html.theme-dark #transactions-page .text-gray-800,
    html.theme-dark #transactions-page .text-gray-700,
    html.theme-dark #transactions-page .text-gray-600 {
        color: #e5e7eb !important;
    }

    html.theme-dark #transactions-page .text-gray-500,
    html.theme-dark #transactions-page .text-gray-400 {
        color: #9ca3af !important;
    }

    html.theme-dark #transactions-page .transaction-input {
        background: #111827 !important;
        border-color: #4b5563 !important;
        color: #f9fafb !important;
    }

    html.theme-dark #transactions-page .transaction-input::placeholder {
        color: #9ca3af !important;
    }

    html.theme-dark #transactions-page .bg-blue-50,
    html.theme-dark #transactions-page .bg-gray-50 {
        background: #1f2937 !important;
    }

    html.theme-dark #transactions-page .border-gray-100,
    html.theme-dark #transactions-page .border-gray-200,
    html.theme-dark #transactions-page .border-gray-300 {
        border-color: #374151 !important;
    }

    html.theme-dark #transactions-page .transaction-table tbody tr,
    html.theme-dark #transactions-page .transaction-table tbody tr.bg-white {
        background: #111827 !important;
        color: #d1d5db !important;
    }

    html.theme-dark #transactions-page .transaction-table tbody tr:hover {
        background: #1f2937 !important;
    }

    html.theme-dark #transactions-page .bg-green-100 {
        background: #064e3b !important;
        color: #a7f3d0 !important;
    }

    html.theme-dark #transactions-page .bg-red-100 {
        background: #7f1d1d !important;
        color: #fecaca !important;
    }

    html.theme-dark #transactions-page .bg-blue-100 {
        background: #1e3a8a !important;
        color: #dbeafe !important;
    }

    html.theme-dark #transactions-page .bg-amber-100 {
        background: #78350f !important;
        color: #fde68a !important;
    }

    html.theme-dark #transactions-page .bg-green-50 {
        background: #064e3b !important;
        border-color: #047857 !important;
        color: #d1fae5 !important;
    }

    html.theme-dark #transactions-page .bg-red-50 {
        background: #7f1d1d !important;
        border-color: #b91c1c !important;
        color: #fee2e2 !important;
    }

    @media (max-width: 640px) {
        #transactions-page .transaction-table th,
        #transactions-page .transaction-table td {
            padding: .8rem;
        }
    }
</style>

<?php
    $canManageTransactions = auth()->check()
        && in_array(auth()->user()->role, ['admin', 'manager']);

    $totalIncoming = $transactions->where('type', 'in')->sum('quantity');
    $totalOutgoing = $transactions->where('type', 'out')->sum('quantity');
?>

<div id="transactions-page" class="mx-auto max-w-7xl space-y-6">

    
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm font-medium text-blue-600">
                <span>Stockify</span>
                <span class="text-gray-400">/</span>
                <span>Persediaan</span>
            </div>

            <h1 class="text-2xl font-bold tracking-tight text-gray-800 sm:text-3xl">
                Data Transaksi
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Catat dan pantau pergerakan barang masuk maupun keluar.
            </p>
        </div>

        <button
            type="button"
            onclick="openTransactionForm()"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
        >
            <span class="text-lg leading-none">+</span>
            Tambah Transaksi
        </button>
    </div>

    
    <?php if(session('success')): ?>
        <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800" role="status">
            ✓ <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700" role="alert">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700" role="alert">
            <p class="mb-2 font-semibold">Ada data yang perlu diperiksa:</p>
            <ul class="list-inside list-disc space-y-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <div class="transaction-card flex items-center gap-4 p-5">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-2xl">
                📋
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Transaksi</p>
                <p class="mt-1 text-2xl font-bold text-gray-800">
                    <?php echo e($transactions->count()); ?>

                </p>
                <p class="mt-1 text-xs text-gray-400">Transaksi tercatat</p>
            </div>
        </div>

        <div class="transaction-card flex items-center gap-4 p-5">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-green-100 text-2xl">
                ↓
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Barang Masuk</p>
                <p class="mt-1 text-2xl font-bold text-gray-800">
                    <?php echo e($totalIncoming); ?>

                </p>
                <p class="mt-1 text-xs text-gray-400">Unit tercatat masuk</p>
            </div>
        </div>

        <div class="transaction-card flex items-center gap-4 p-5 sm:col-span-2 xl:col-span-1">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-red-100 text-2xl">
                ↑
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Barang Keluar</p>
                <p class="mt-1 text-2xl font-bold text-gray-800">
                    <?php echo e($totalOutgoing); ?>

                </p>
                <p class="mt-1 text-xs text-gray-400">Unit tercatat keluar</p>
            </div>
        </div>
    </div>

    
    <div
        id="formTransaksi"
        class="transaction-card hidden overflow-hidden"
    >
        <div class="flex items-center justify-between gap-3 border-b border-gray-100 bg-blue-50 px-5 py-4 sm:px-6">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Tambah Transaksi Baru</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Lengkapi informasi pergerakan barang.
                </p>
            </div>

            <button
                type="button"
                onclick="closeTransactionForm()"
                class="rounded-lg px-3 py-2 text-sm text-gray-500 hover:bg-white"
                aria-label="Tutup formulir"
            >
                ✕
            </button>
        </div>

        <form
            action="<?php echo e(route('transactions.store')); ?>"
            method="POST"
            class="space-y-5 p-5 sm:p-6"
        >
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                
                <div>
                    <label for="transaction_product" class="transaction-label">
                        Produk <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="transaction_product"
                        name="product_id"
                        required
                        class="transaction-input"
                    >
                        <option value="">-- Pilih Produk --</option>

                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($product->id); ?>"
                                <?php echo e(old('product_id') == $product->id ? 'selected' : ''); ?>

                            >
                                <?php echo e($product->name); ?> (Stok: <?php echo e($product->stock); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div>
                    <label for="transaction_supplier" class="transaction-label">
                        Supplier
                    </label>

                    <select
                        id="transaction_supplier"
                        name="supplier_id"
                        class="transaction-input"
                    >
                        <option value="">-- Pilih Supplier --</option>

                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($supplier->id); ?>"
                                <?php echo e(old('supplier_id') == $supplier->id ? 'selected' : ''); ?>

                            >
                                <?php echo e($supplier->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div>
                    <label for="transaction_type" class="transaction-label">
                        Tipe Transaksi <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="transaction_type"
                        name="type"
                        required
                        class="transaction-input"
                    >
                        <option value="">-- Pilih Tipe --</option>
                        <option value="in" <?php echo e(old('type') == 'in' ? 'selected' : ''); ?>>
                            Barang Masuk
                        </option>
                        <option value="out" <?php echo e(old('type') == 'out' ? 'selected' : ''); ?>>
                            Barang Keluar
                        </option>
                    </select>
                </div>

                
                <div>
                    <label for="transaction_quantity" class="transaction-label">
                        Jumlah <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="number"
                        id="transaction_quantity"
                        name="quantity"
                        min="1"
                        value="<?php echo e(old('quantity')); ?>"
                        required
                        placeholder="Masukkan jumlah barang"
                        class="transaction-input"
                    >
                </div>

                
                <div>
                    <label for="transaction_date" class="transaction-label">
                        Tanggal Transaksi <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="date"
                        id="transaction_date"
                        name="transaction_date"
                        value="<?php echo e(old('transaction_date', date('Y-m-d'))); ?>"
                        required
                        class="transaction-input"
                    >
                </div>

                
                <div>
                    <label for="transaction_description" class="transaction-label">
                        Keterangan
                    </label>

                    <textarea
                        id="transaction_description"
                        name="description"
                        rows="3"
                        placeholder="Masukkan keterangan transaksi..."
                        class="transaction-input"
                    ><?php echo e(old('description')); ?></textarea>
                </div>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">
                <button
                    type="button"
                    onclick="closeTransactionForm()"
                    class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-blue-700"
                >
                    Simpan Transaksi
                </button>
            </div>
        </form>
    </div>

    
    <div class="transaction-card overflow-hidden">
        <div class="flex flex-col gap-4 border-b border-gray-100 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Daftar Transaksi</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Riwayat barang masuk dan barang keluar.
                </p>
            </div>

            <div class="w-full sm:max-w-sm">
                <label for="transactionSearch" class="mb-2 block text-xs font-semibold text-gray-500">
                    Cari transaksi
                </label>

                <input
                    type="search"
                    id="transactionSearch"
                    class="transaction-input"
                    placeholder="Produk, supplier, tipe, tanggal..."
                    autocomplete="off"
                >
            </div>
        </div>

        <div class="flex items-center justify-between gap-3 bg-gray-50 px-5 py-3 text-xs text-gray-500 sm:px-6">
            <span>
                Jumlah data:
                <strong id="transactionVisibleCount" class="text-gray-700"><?php echo e($transactions->count()); ?></strong>
                transaksi
            </span>
            <span>Riwayat persediaan Stockify</span>
        </div>

        <div class="overflow-x-auto">
            <table class="transaction-table w-full text-left text-sm text-gray-600">
                <thead class="bg-blue-700 text-xs uppercase tracking-wider text-white">
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Supplier</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody id="transactionTableBody">
                    <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr
                            class="border-b border-gray-100 bg-white"
                            data-transaction-row
                            data-search="<?php echo e(strtolower(($transaction->product->name ?? '') . ' ' . ($transaction->supplier->name ?? '') . ' ' . ($transaction->type == 'in' ? 'barang masuk masuk' : 'barang keluar keluar') . ' ' . $transaction->quantity . ' ' . $transaction->transaction_date . ' ' . ($transaction->description ?? ''))); ?>"
                        >
                            <td class="font-medium text-gray-500">
                                <?php echo e($loop->iteration); ?>

                            </td>

                            <td>
                                <div class="font-semibold text-gray-800">
                                    <?php echo e($transaction->product->name ?? '-'); ?>

                                </div>
                                <div class="mt-1 text-xs text-gray-400">
                                    ID Transaksi: <?php echo e($transaction->id); ?>

                                </div>
                            </td>

                            <td>
                                <?php echo e($transaction->supplier->name ?? '-'); ?>

                            </td>

                            <td>
                                <?php if($transaction->type == 'in'): ?>
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-3 py-1.5 text-xs font-semibold text-green-700">
                                        <span>↓</span>
                                        Barang Masuk
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700">
                                        <span>↑</span>
                                        Barang Keluar
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td class="font-bold text-gray-800">
                                <?php echo e($transaction->quantity); ?> unit
                            </td>

                            <td>
                                <?php echo e($transaction->transaction_date); ?>

                            </td>

                            <td class="max-w-xs whitespace-normal">
                                <?php echo e($transaction->description ?: '-'); ?>

                            </td>

                            <td>
                                <?php if($canManageTransactions): ?>
                                    <div class="flex items-center gap-2">
                                        <a
                                            href="<?php echo e(route('transactions.edit', $transaction->id)); ?>"
                                            class="transaction-action bg-amber-100 text-amber-700 hover:bg-amber-200"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="<?php echo e(route('transactions.destroy', $transaction->id)); ?>"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus transaksi ini? Pastikan perubahan stok sesuai dengan logika aplikasi.')"
                                        >
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                class="transaction-action bg-red-100 text-red-700 hover:bg-red-200"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    <span class="text-xs text-gray-400">
                                        Hanya lihat
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr id="transactionEmptyRow">
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-3xl">
                                    📋
                                </div>
                                <p class="font-semibold text-gray-700">Belum ada transaksi</p>
                                <p class="mt-1 text-sm text-gray-500">
                                    Transaksi yang ditambahkan akan muncul di sini.
                                </p>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <tr id="transactionNoResults" class="hidden">
                        <td colspan="8" class="px-6 py-10 text-center">
                            <p class="font-semibold text-gray-700">Transaksi tidak ditemukan</p>
                            <p class="mt-1 text-sm text-gray-500">
                                Coba gunakan kata kunci yang berbeda.
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-100 px-5 py-4 text-xs text-gray-400 sm:px-6">
            Riwayat transaksi Stockify
        </div>
    </div>

</div>

<script>
    function openTransactionForm() {
        const form = document.getElementById('formTransaksi');

        if (form) {
            form.classList.remove('hidden');
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });

            const productInput = document.getElementById('transaction_product');

            if (productInput) {
                setTimeout(() => productInput.focus(), 300);
            }
        }
    }

    function closeTransactionForm() {
        const form = document.getElementById('formTransaksi');

        if (form) {
            form.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('transactionSearch');
        const rows = Array.from(document.querySelectorAll('[data-transaction-row]'));
        const countElement = document.getElementById('transactionVisibleCount');
        const noResults = document.getElementById('transactionNoResults');
        const emptyRow = document.getElementById('transactionEmptyRow');

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

        // Tampilkan kembali formulir jika validasi gagal.
        <?php if($errors->any()): ?>
            openTransactionForm();
        <?php endif; ?>
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/transactions/index.blade.php ENDPATH**/ ?>