<?php $__env->startSection('content'); ?>

<div class="space-y-6">

    
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Dashboard
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Ringkasan aktivitas dan kondisi stok Stockify
        </p>
    </div>


    
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-5">

        
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Total Produk
                    </p>

                    <p class="mt-2 text-3xl font-bold text-gray-800">
                        <?php echo e($totalProducts); ?>

                    </p>
                </div>

                <div class="rounded-lg bg-blue-100 p-3">
                    <svg class="h-6 w-6 text-blue-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                    </svg>
                </div>

            </div>
        </div>


        
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Barang Masuk
                    </p>

                    <p class="mt-2 text-3xl font-bold text-green-600">
                        <?php echo e($totalIncoming); ?>

                    </p>
                </div>

                <div class="rounded-lg bg-green-100 p-3">
                    <svg class="h-6 w-6 text-green-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4"/>
                    </svg>
                </div>

            </div>
        </div>


        
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Barang Keluar
                    </p>

                    <p class="mt-2 text-3xl font-bold text-red-600">
                        <?php echo e($totalOutgoing); ?>

                    </p>
                </div>

                <div class="rounded-lg bg-red-100 p-3">
                    <svg class="h-6 w-6 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 20V4m-8 8h16"/>
                    </svg>
                </div>

            </div>
        </div>


        
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Stock Opname
                    </p>

                    <p class="mt-2 text-3xl font-bold text-purple-600">
                        <?php echo e($totalStockOpnames); ?>

                    </p>
                </div>

                <div class="rounded-lg bg-purple-100 p-3">
                    <svg class="h-6 w-6 text-purple-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a3 3 0 016 0M9 5h6"/>
                    </svg>
                </div>

            </div>
        </div>


        
        <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-gray-500">
                        Stok Rendah
                    </p>

                    <p class="mt-2 text-3xl font-bold text-orange-600">
                        <?php echo e($lowStockProducts->count()); ?>

                    </p>
                </div>

                <div class="rounded-lg bg-orange-100 p-3">
                    <svg class="h-6 w-6 text-orange-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/>
                    </svg>
                </div>

            </div>
        </div>

    </div>

    

<div class="app-card mt-6 overflow-hidden">
    <div class="border-b p-5 sm:p-6" style="border-color:var(--line)">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path d="M3 3v18h18"/>
                    <path d="M7 14h3v4H7zM12 9h3v9h-3zM17 5h3v13h-3z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold">Kondisi Persediaan</h3>
                <p class="app-muted mt-1 text-sm">
                    Komposisi produk berdasarkan jumlah stok saat ini
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 items-center gap-6 p-5 sm:grid-cols-2 sm:p-6">
        <div class="relative mx-auto h-64 w-full max-w-sm">
            <canvas id="stockCompositionChart"></canvas>
        </div>

        <div class="space-y-4">
            <div class="flex items-center justify-between rounded-xl p-4"
                style="background:var(--surface-soft)">
                <div class="flex items-center gap-3">
                    <span class="h-3 w-3 rounded-full bg-green-500"></span>
                    <div>
                        <p class="text-sm font-semibold">Stok Aman</p>
                        <p class="app-muted text-xs">Lebih dari 5 unit</p>
                    </div>
                </div>
                <span class="text-xl font-extrabold text-green-600">
                    <?php echo e($totalSafeStock); ?>

                </span>
            </div>

            <div class="flex items-center justify-between rounded-xl p-4"
                style="background:var(--surface-soft)">
                <div class="flex items-center gap-3">
                    <span class="h-3 w-3 rounded-full bg-orange-500"></span>
                    <div>
                        <p class="text-sm font-semibold">Stok Rendah</p>
                        <p class="app-muted text-xs">1–5 unit</p>
                    </div>
                </div>
                <span class="text-xl font-extrabold text-orange-600">
                    <?php echo e($totalLowStock); ?>

                </span>
            </div>

            <div class="flex items-center justify-between rounded-xl p-4"
                style="background:var(--surface-soft)">
                <div class="flex items-center gap-3">
                    <span class="h-3 w-3 rounded-full bg-red-500"></span>
                    <div>
                        <p class="text-sm font-semibold">Stok Habis</p>
                        <p class="app-muted text-xs">0 unit atau kurang</p>
                    </div>
                </div>
                <span class="text-xl font-extrabold text-red-600">
                    <?php echo e($totalOutOfStock); ?>

                </span>
            </div>

            <p class="app-muted text-xs leading-5">
                Total kategori kondisi stok:
                <strong><?php echo e($totalSafeStock + $totalLowStock + $totalOutOfStock); ?> produk</strong>.
                Periksa produk dengan stok rendah atau habis untuk menentukan tindakan berikutnya.
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('stockCompositionChart');
    if (!canvas || typeof Chart === 'undefined') return;

    const isDark = document.documentElement.classList.contains('theme-dark');

    new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: ['Stok Aman', 'Stok Rendah', 'Stok Habis'],
            datasets: [{
                data: [
                    <?php echo e($totalSafeStock); ?>,
                    <?php echo e($totalLowStock); ?>,
                    <?php echo e($totalOutOfStock); ?>

                ],
                backgroundColor: ['#16a34a', '#f97316', '#ef4444'],
                borderColor: isDark ? '#111e32' : '#ffffff',
                borderWidth: 4,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    padding: 12,
                    callbacks: {
                        label: function (context) {
                            return context.label + ': ' + context.raw + ' produk';
                        }
                    }
                }
            }
        }
    });
});
</script>



    
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">


        
        <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

            <div class="flex items-center justify-between border-b px-6 py-4">

                <div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Produk Stok Rendah
                    </h3>

                    <p class="text-sm text-gray-500">
                        Produk dengan stok 5 atau kurang
                    </p>
                </div>

                <a href="<?php echo e(route('products.index')); ?>"
                    class="text-sm font-medium text-blue-600 hover:text-blue-800">
                    Lihat Produk
                </a>

            </div>


            <div class="overflow-x-auto">

                <?php if($lowStockProducts->count() > 0): ?>

                    <table class="w-full text-left text-sm">

                        <thead class="bg-gray-50 text-xs uppercase text-gray-500">

                            <tr>
                                <th class="px-6 py-3">
                                    Produk
                                </th>

                                <th class="px-6 py-3 text-right">
                                    Stok
                                </th>
                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-200">

                            <?php $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4">

                                        <div class="font-medium text-gray-800">
                                            <?php echo e($product->name); ?>

                                        </div>

                                        <div class="text-xs text-gray-500">
                                            <?php echo e($product->category->name ?? '-'); ?>

                                        </div>

                                    </td>


                                    <td class="px-6 py-4 text-right">

                                        <?php if($product->stock <= 0): ?>

                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                Habis
                                            </span>

                                        <?php else: ?>

                                            <span class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700">
                                                <?php echo e($product->stock); ?>

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>

                    </table>

                <?php else: ?>

                    <div class="px-6 py-10 text-center">

                        <p class="text-sm text-gray-500">
                            Tidak ada produk dengan stok rendah.
                        </p>

                    </div>

                <?php endif; ?>

            </div>

        </div>



        
        <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

            <div class="flex items-center justify-between border-b px-6 py-4">

                <div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Stock Opname Terbaru
                    </h3>

                    <p class="text-sm text-gray-500">
                        Aktivitas pengecekan stok terbaru
                    </p>
                </div>

                <a href="<?php echo e(route('stock-opnames.index')); ?>"
                    class="text-sm font-medium text-blue-600 hover:text-blue-800">
                    Lihat Semua
                </a>

            </div>


            <div class="overflow-x-auto">

                <?php if($latestStockOpnames->count() > 0): ?>

                    <table class="w-full text-left text-sm">

                        <thead class="bg-gray-50 text-xs uppercase text-gray-500">

                            <tr>

                                <th class="px-6 py-3">
                                    Produk
                                </th>

                                <th class="px-6 py-3">
                                    Sistem
                                </th>

                                <th class="px-6 py-3">
                                    Fisik
                                </th>

                                <th class="px-6 py-3">
                                    Selisih
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-200">

                            <?php $__currentLoopData = $latestStockOpnames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opname): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4">

                                        <div class="font-medium text-gray-800">
                                            <?php echo e($opname->product->name ?? '-'); ?>

                                        </div>

                                        <div class="text-xs text-gray-500">
                                            <?php echo e($opname->opname_date->format('d/m/Y')); ?>

                                        </div>

                                    </td>


                                    <td class="px-6 py-4 text-gray-700">
                                        <?php echo e($opname->system_stock); ?>

                                    </td>


                                    <td class="px-6 py-4 text-gray-700">
                                        <?php echo e($opname->physical_stock); ?>

                                    </td>


                                    <td class="px-6 py-4">

                                        <?php if($opname->difference > 0): ?>

                                            <span class="inline-flex rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                                +<?php echo e($opname->difference); ?>

                                            </span>

                                        <?php elseif($opname->difference < 0): ?>

                                            <span class="inline-flex rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                                <?php echo e($opname->difference); ?>

                                            </span>

                                        <?php else: ?>

                                            <span class="inline-flex rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-700">
                                                0
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>

                    </table>

                <?php else: ?>

                    <div class="px-6 py-10 text-center">

                        <p class="text-sm text-gray-500">
                            Belum ada aktivitas stock opname.
                        </p>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>


    
    <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200">

        <div class="flex items-center justify-between border-b px-6 py-4">

            <div>
                <h3 class="text-lg font-semibold text-gray-800">
                    Transaksi Terbaru
                </h3>

                <p class="text-sm text-gray-500">
                    Aktivitas barang masuk dan keluar
                </p>
            </div>

            <a href="<?php echo e(route('transactions.index')); ?>"
                class="text-sm font-medium text-blue-600 hover:text-blue-800">
                Lihat Semua
            </a>

        </div>


        <div class="overflow-x-auto">

            <?php if($latestTransactions->count() > 0): ?>

                <table class="w-full text-left text-sm">

                    <thead class="bg-gray-50 text-xs uppercase text-gray-500">

                        <tr>

                            <th class="px-6 py-3">
                                Tanggal
                            </th>

                            <th class="px-6 py-3">
                                Produk
                            </th>

                            <th class="px-6 py-3">
                                Jenis
                            </th>

                            <th class="px-6 py-3">
                                Jumlah
                            </th>

                            <th class="px-6 py-3">
                                Keterangan
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200">

                        <?php $__currentLoopData = $latestTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 text-gray-600">
                                    <?php echo e($transaction->transaction_date->format('d/m/Y')); ?>

                                </td>


                                <td class="px-6 py-4 font-medium text-gray-800">
                                    <?php echo e($transaction->product->name ?? '-'); ?>

                                </td>


                                <td class="px-6 py-4">

                                    <?php if($transaction->type === 'in'): ?>

                                        <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                            Masuk
                                        </span>

                                    <?php else: ?>

                                        <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                            Keluar
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <td class="px-6 py-4 font-semibold text-gray-800">
                                    <?php echo e($transaction->quantity); ?>

                                </td>


                                <td class="px-6 py-4 text-gray-500">
                                    <?php echo e($transaction->description ?? '-'); ?>

                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>

                </table>

            <?php else: ?>

                <div class="px-6 py-10 text-center">

                    <p class="text-sm text-gray-500">
                        Belum ada transaksi.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\stockify\resources\views/dashboard.blade.php ENDPATH**/ ?>