


<?php $__env->startSection('content'); ?>

<style>
    #products-page .product-input {
        width: 100%;
        border: 1px solid #d1d5db;
        border-radius: 0.65rem;
        background: #f9fafb;
        padding: 0.7rem 0.85rem;
        color: #111827;
        font-size: 0.875rem;
        transition: border-color .2s, box-shadow .2s;
    }

    #products-page .product-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .15);
    }

    #products-page .product-label {
        display: block;
        margin-bottom: 0.5rem;
        color: #374151;
        font-size: 0.875rem;
        font-weight: 600;
    }

    #products-page .product-card {
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        background: white;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
    }

    #products-page .product-table th,
    #products-page .product-table td {
        padding: 1rem 1.25rem;
        white-space: nowrap;
    }

    #products-page .product-table tbody tr {
        transition: background-color .15s;
    }

    #products-page .product-table tbody tr:hover {
        background: #f8fafc;
    }

    #products-page .product-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: .55rem;
        padding: .55rem .8rem;
        font-size: .75rem;
        font-weight: 600;
        transition: background-color .2s;
    }

    #products-page .product-action:focus-visible,
    #products-page button:focus-visible {
        outline: 3px solid #93c5fd;
        outline-offset: 2px;
    }

    #products-page .product-modal-panel {
        max-height: 90vh;
        overflow-y: auto;
    }

    @media (max-width: 640px) {
        #products-page .product-table th,
        #products-page .product-table td {
            padding: .8rem;
        }
    }
    
/* =========================================
   MODE GELAP - HALAMAN PRODUK STOCKIFY
   ========================================= */

html.theme-dark #products-page .product-card {
    background-color: #111827 !important;
    border-color: #374151 !important;
    color: #e5e7eb;
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.12);
}

/* Judul dan teks */
html.theme-dark #products-page .text-gray-800,
html.theme-dark #products-page .text-gray-700,
html.theme-dark #products-page .text-gray-600 {
    color: #e5e7eb !important;
}

html.theme-dark #products-page .text-gray-500,
html.theme-dark #products-page .text-gray-400 {
    color: #9ca3af !important;
}

/* Header form dan area pencarian */
html.theme-dark #products-page .bg-blue-50,
html.theme-dark #products-page .bg-gray-50 {
    background-color: #1f2937 !important;
}

/* Input, select, textarea */
html.theme-dark #products-page .product-input {
    background-color: #111827 !important;
    border-color: #4b5563 !important;
    color: #f9fafb !important;
}

html.theme-dark #products-page .product-input::placeholder {
    color: #9ca3af !important;
}

/* Garis pembatas */
html.theme-dark #products-page .border-gray-100,
html.theme-dark #products-page .border-gray-200,
html.theme-dark #products-page .border-gray-300 {
    border-color: #374151 !important;
}

/* Tabel produk */
html.theme-dark #products-page .product-table thead {
    background-color: #1d4ed8 !important;
}

html.theme-dark #products-page .product-table tbody tr,
html.theme-dark #products-page .product-table tbody tr.bg-white {
    background-color: #111827 !important;
    color: #d1d5db !important;
}

html.theme-dark #products-page .product-table tbody tr:hover {
    background-color: #1f2937 !important;
}

/* Badge stok */
html.theme-dark #products-page .bg-green-100 {
    background-color: #064e3b !important;
    color: #a7f3d0 !important;
}

html.theme-dark #products-page .bg-red-100 {
    background-color: #7f1d1d !important;
    color: #fecaca !important;
}

html.theme-dark #products-page .bg-amber-100 {
    background-color: #78350f !important;
    color: #fde68a !important;
}

/* Ikon ringkasan */
html.theme-dark #products-page .bg-blue-100 {
    background-color: #1e3a8a !important;
    color: #dbeafe !important;
}

/* Garis tabel dan footer */
html.theme-dark #products-page .border-t,
html.theme-dark #products-page .border-b {
    border-color: #374151 !important;
}

/* Tombol tutup form */
html.theme-dark #products-page button:hover.bg-white {
    background-color: #374151 !important;
    color: #f9fafb !important;
}

</style>

<?php
    $canManageProducts = auth()->check()
        && in_array(auth()->user()->role, ['admin', 'manager']);
?>

<div id="products-page" class="mx-auto max-w-7xl space-y-6">

    
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm font-medium text-blue-600">
                <span>Stockify</span>
                <span class="text-gray-400">/</span>
                <span>Inventaris</span>
            </div>

            <h1 class="text-2xl font-bold tracking-tight text-gray-800 sm:text-3xl">
                Data Produk
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Kelola dan pantau seluruh produk yang tersedia di gudang.
            </p>
        </div>

        <?php if($canManageProducts): ?>
            <button
                type="button"
                onclick="openProductForm()"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
            >
                <span class="text-lg leading-none">+</span>
                Tambah Produk
            </button>
        <?php endif; ?>
    </div>

    
    <?php if(session('success')): ?>
        <div class="flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-800" role="status">
            <span class="font-bold">✓</span>
            <div><?php echo e(session('success')); ?></div>
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
        <div class="product-card flex items-center gap-4 p-5">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-xl">
                📦
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Produk</p>
                <p class="mt-1 text-2xl font-bold text-gray-800">
                    <?php echo e($products->count()); ?>

                </p>
                <p class="mt-1 text-xs text-gray-400">Produk terdaftar</p>
            </div>
        </div>

        <div class="product-card flex items-center gap-4 p-5">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-green-100 text-xl">
                ✓
            </div>
            <div>
                <p class="text-sm text-gray-500">Stok Tersedia</p>
                <p class="mt-1 text-2xl font-bold text-gray-800">
                    <?php echo e($products->sum('stock')); ?>

                </p>
                <p class="mt-1 text-xs text-gray-400">Total unit persediaan</p>
            </div>
        </div>

        <div class="product-card flex items-center gap-4 p-5 sm:col-span-2 xl:col-span-1">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-red-100 text-xl">
                !
            </div>
            <div>
                <p class="text-sm text-gray-500">Stok Menipis</p>
                <p class="mt-1 text-2xl font-bold text-gray-800">
                    <?php echo e($products->where('stock', '<=', 5)->count()); ?>

                </p>
                <p class="mt-1 text-xs text-gray-400">Stok 5 unit atau kurang</p>
            </div>
        </div>
    </div>

    
    <?php if($canManageProducts): ?>
        <div
            id="formTambahProduk"
            class="product-card overflow-hidden <?php echo e($errors->any() ? '' : 'hidden'); ?>"
        >
            <div class="flex items-center justify-between gap-3 border-b border-gray-100 bg-blue-50 px-5 py-4 sm:px-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">
                        Tambah Produk Baru
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Lengkapi informasi produk di bawah ini.
                    </p>
                </div>

                <button
                    type="button"
                    onclick="closeProductForm()"
                    class="rounded-lg px-3 py-2 text-sm font-medium text-gray-500 hover:bg-white hover:text-gray-800"
                    aria-label="Tutup formulir"
                >
                    ✕
                </button>
            </div>

            <form
                action="<?php echo e(route('products.store')); ?>"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-5 p-5 sm:p-6"
            >
                <?php echo csrf_field(); ?>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    
                    <div>
                        <label for="name" class="product-label">Nama Produk <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="<?php echo e(old('name')); ?>"
                            required
                            maxlength="255"
                            class="product-input"
                            placeholder="Contoh: Mouse Wireless"
                        >
                    </div>

                    
                    <div>
                        <label for="category_id" class="product-label">Kategori <span class="text-red-500">*</span></label>
                        <select
                            id="category_id"
                            name="category_id"
                            required
                            class="product-input"
                        >
                            <option value="">-- Pilih Kategori --</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option
                                    value="<?php echo e($category->id); ?>"
                                    <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>

                                >
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div>
                        <label for="supplier_id" class="product-label">Supplier</label>
                        <select
                            id="supplier_id"
                            name="supplier_id"
                            class="product-input"
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
                        <label for="stock" class="product-label">Stok Awal <span class="text-red-500">*</span></label>
                        <input
                            type="number"
                            id="stock"
                            name="stock"
                            value="<?php echo e(old('stock', 0)); ?>"
                            required
                            min="0"
                            class="product-input"
                            placeholder="0"
                        >
                    </div>

                    
                    <div>
                        <label for="purchase_price" class="product-label">Harga Beli (Rp) <span class="text-red-500">*</span></label>
                        <input
                            type="number"
                            id="purchase_price"
                            name="purchase_price"
                            value="<?php echo e(old('purchase_price')); ?>"
                            required
                            min="0"
                            step="1"
                            class="product-input"
                            placeholder="0"
                        >
                    </div>

                    
                    <div>
                        <label for="selling_price" class="product-label">Harga Jual (Rp) <span class="text-red-500">*</span></label>
                        <input
                            type="number"
                            id="selling_price"
                            name="selling_price"
                            value="<?php echo e(old('selling_price')); ?>"
                            required
                            min="0"
                            step="1"
                            class="product-input"
                            placeholder="0"
                        >
                    </div>

                    
                    <div class="md:col-span-2">
                        <label for="description" class="product-label">Deskripsi Produk</label>
                        <textarea
                            id="description"
                            name="description"
                            rows="3"
                            class="product-input"
                            placeholder="Tuliskan deskripsi produk (opsional)"
                        ><?php echo e(old('description')); ?></textarea>
                    </div>

                    
                    <div class="md:col-span-2">
                        <label for="image" class="product-label">Gambar Produk</label>
                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/png,image/jpeg,image/jpg"
                            class="product-input"
                        >
                        <p class="mt-2 text-xs text-gray-500">
                            Format JPG, JPEG, atau PNG. Maksimal 2 MB.
                        </p>
                        <div id="imagePreviewContainer" class="mt-3 hidden">
                            <p class="mb-2 text-xs font-medium text-gray-500">Pratinjau gambar</p>
                            <img id="imagePreview" src="" alt="Pratinjau gambar produk" class="h-28 w-28 rounded-xl border border-gray-200 object-cover">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:justify-end">
                    <button
                        type="button"
                        onclick="closeProductForm()"
                        class="rounded-xl border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-50"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700"
                    >
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    <?php endif; ?>

    
    <div class="product-card overflow-hidden">
        <div class="flex flex-col gap-4 border-b border-gray-100 p-5 sm:p-6 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-lg font-bold text-gray-800">Daftar Produk</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Data produk dan persediaan yang tercatat di Stockify.
                </p>
            </div>

            <div class="w-full lg:max-w-sm">
                <label for="productSearch" class="mb-2 block text-xs font-semibold text-gray-500">
                    Cari produk
                </label>
                <div class="relative">
                    <input
                        type="search"
                        id="productSearch"
                        class="product-input"
                        placeholder="Cari nama, kategori, supplier..."
                        autocomplete="off"
                    >
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-2 bg-gray-50 px-5 py-3 text-xs text-gray-500 sm:px-6">
            <span>Jumlah data: <strong id="visibleProductCount" class="text-gray-700"><?php echo e($products->count()); ?></strong> produk</span>
            <span>Stok menipis ditandai warna merah</span>
        </div>

        <div class="overflow-x-auto">
            <table class="product-table w-full text-left text-sm text-gray-600">
                <thead class="bg-blue-700 text-xs uppercase tracking-wider text-white">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Supplier</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <?php if($canManageProducts): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>

                <tbody id="productTableBody">
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr
                            class="border-b border-gray-100 bg-white"
                            data-product-row
                            data-search="<?php echo e(strtolower($product->name . ' ' . ($product->category->name ?? '') . ' ' . ($product->supplier->name ?? '') . ' ' . $product->purchase_price . ' ' . $product->selling_price . ' ' . $product->stock)); ?>"
                        >
                            <td class="font-medium text-gray-500">
                                <?php echo e($loop->iteration); ?>

                            </td>

                            <td>
                                <?php if($product->image): ?>
                                    <img
                                        src="<?php echo e(asset('storage/' . $product->image)); ?>"
                                        alt="<?php echo e($product->name); ?>"
                                        loading="lazy"
                                        class="h-14 w-14 rounded-xl border border-gray-200 object-cover"
                                    >
                                <?php else: ?>
                                    <div class="flex h-14 w-14 items-center justify-center rounded-xl border border-dashed border-gray-300 bg-gray-50 text-2xl">
                                        📦
                                    </div>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="font-semibold text-gray-800">
                                    <?php echo e($product->name); ?>

                                </div>
                                <div class="mt-1 text-xs text-gray-400">
                                    ID Produk: <?php echo e($product->id); ?>

                                </div>
                            </td>

                            <td>
                                <span class="inline-flex rounded-lg bg-blue-50 px-3 py-1.5 text-xs font-medium text-blue-700">
                                    <?php echo e($product->category->name ?? '-'); ?>

                                </span>
                            </td>

                            <td><?php echo e($product->supplier->name ?? '-'); ?></td>

                            <td class="font-medium text-gray-700">
                                Rp <?php echo e(number_format($product->purchase_price, 0, ',', '.')); ?>

                            </td>

                            <td class="font-semibold text-gray-800">
                                Rp <?php echo e(number_format($product->selling_price, 0, ',', '.')); ?>

                            </td>

                            <td>
                                <?php if($product->stock <= 5): ?>
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-100 px-3 py-1.5 text-xs font-bold text-red-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                        <?php echo e($product->stock); ?>

                                    </span>
                                    <p class="mt-1 text-xs text-red-500">Stok menipis</p>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-100 px-3 py-1.5 text-xs font-bold text-green-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                        <?php echo e($product->stock); ?>

                                    </span>
                                    <p class="mt-1 text-xs text-green-600">Tersedia</p>
                                <?php endif; ?>
                            </td>

                            <?php if($canManageProducts): ?>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <a
                                            href="<?php echo e(route('products.edit', $product->id)); ?>"
                                            class="product-action bg-amber-100 text-amber-700 hover:bg-amber-200"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="<?php echo e(route('products.destroy', $product->id)); ?>"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus produk <?php echo e(addslashes($product->name)); ?>?')"
                                        >
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                class="product-action bg-red-100 text-red-700 hover:bg-red-200"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr id="noProductsRow">
                            <td
                                colspan="<?php echo e($canManageProducts ? 9 : 8); ?>"
                                class="px-6 py-12 text-center"
                            >
                                <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-3xl">
                                    📦
                                </div>
                                <p class="font-semibold text-gray-700">Belum ada data produk</p>
                                <p class="mt-1 text-sm text-gray-500">
                                    Produk yang ditambahkan akan muncul di sini.
                                </p>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <tr id="noSearchResults" class="hidden">
                        <td
                            colspan="<?php echo e($canManageProducts ? 9 : 8); ?>"
                            class="px-6 py-10 text-center"
                        >
                            <p class="font-semibold text-gray-700">Produk tidak ditemukan</p>
                            <p class="mt-1 text-sm text-gray-500">
                                Coba gunakan kata kunci yang berbeda.
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-100 px-5 py-4 text-xs text-gray-400 sm:px-6">
            Data produk Stockify
        </div>
    </div>

</div>

<script>
    function openProductForm() {
        const form = document.getElementById('formTambahProduk');

        if (form) {
            form.classList.remove('hidden');
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });

            const nameInput = document.getElementById('name');
            if (nameInput) {
                setTimeout(() => nameInput.focus(), 300);
            }
        }
    }

    function closeProductForm() {
        const form = document.getElementById('formTambahProduk');

        if (form) {
            form.classList.add('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('productSearch');
        const rows = Array.from(document.querySelectorAll('[data-product-row]'));
        const countElement = document.getElementById('visibleProductCount');
        const noResults = document.getElementById('noSearchResults');
        const noProducts = document.getElementById('noProductsRow');

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const keyword = this.value.trim().toLowerCase();
                let visibleCount = 0;

                rows.forEach(function (row) {
                    const searchableText = row.dataset.search || '';
                    const matches = searchableText.includes(keyword);

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

                if (noProducts) {
                    noProducts.classList.toggle(
                        'hidden',
                        keyword.length > 0
                    );
                }
            });
        }

        // Pratinjau gambar sebelum diunggah.
        const imageInput = document.getElementById('image');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');

        if (imageInput && previewContainer && previewImage) {
            imageInput.addEventListener('change', function () {
                const file = this.files && this.files[0];

                if (!file) {
                    previewImage.removeAttribute('src');
                    previewContainer.classList.add('hidden');
                    return;
                }

                if (!['image/jpeg', 'image/png'].includes(file.type)) {
                    alert('Pilih gambar berformat JPG, JPEG, atau PNG.');
                    this.value = '';
                    previewImage.removeAttribute('src');
                    previewContainer.classList.add('hidden');
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran gambar maksimal 2 MB.');
                    this.value = '';
                    previewImage.removeAttribute('src');
                    previewContainer.classList.add('hidden');
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (event) {
                    previewImage.src = event.target.result;
                    previewContainer.classList.remove('hidden');
                };

                reader.readAsDataURL(file);
            });
        }

        // Jika validasi gagal, arahkan pengguna ke formulir.
        const form = document.getElementById('formTambahProduk');

        if (form && !form.classList.contains('hidden')) {
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/products/index.blade.php ENDPATH**/ ?>