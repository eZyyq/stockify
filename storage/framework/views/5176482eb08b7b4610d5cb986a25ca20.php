
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Stockify</title>

    <style>
        @page {
            margin: 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #333;
        }

        h1 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 5px;
        }

        h2 {
            font-size: 14px;
            margin-top: 25px;
            margin-bottom: 10px;
            color: #1e40af;
        }

        p {
            text-align: center;
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th, td {
            border: 1px solid #999;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #e5e7eb;
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            font-size: 9px;
            text-align: right;
        }
    </style>
</head>
<body>

    <h1>LAPORAN STOCKIFY</h1>
    <p>
        Laporan Persediaan Barang<br>
        Tanggal cetak: <?php echo e(now()->format('d/m/Y H:i')); ?>

    </p>

    
    <h2>1. Daftar Stok Produk</h2>

    <table>
        <thead>
            <tr>
                <th class="center">No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th class="center">Stok</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="center"><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($product->name); ?></td>
                    <td><?php echo e($product->category->name ?? '-'); ?></td>
                    <td class="center"><?php echo e($product->stock); ?></td>
                    <td><?php echo e(number_format($product->purchase_price, 0, ',', '.')); ?></td>
                    <td><?php echo e(number_format($product->selling_price, 0, ',', '.')); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="center">Belum ada data produk.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    
    <h2>2. Laporan Transaksi</h2>

    <table>
        <thead>
            <tr>
                <th class="center">No</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Jenis Transaksi</th>
                <th class="center">Jumlah</th>
                <th>Supplier</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="center"><?php echo e($loop->iteration); ?></td>
                    <td>
                        <?php echo e($transaction->transaction_date
                            ? \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y')
                            : '-'); ?>

                    </td>
                    <td><?php echo e($transaction->product->name ?? '-'); ?></td>
                    <td>
                        <?php echo e($transaction->type === 'in'
                            ? 'Barang Masuk'
                            : 'Barang Keluar'); ?>

                    </td>
                    <td class="center"><?php echo e($transaction->quantity); ?></td>
                    <td><?php echo e($transaction->supplier->name ?? '-'); ?></td>
                    <td><?php echo e($transaction->description ?? '-'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="center">Belum ada data transaksi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    
    <h2>3. Laporan Stock Opname</h2>

    <table>
        <thead>
            <tr>
                <th class="center">No</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th class="center">Stok Sistem</th>
                <th class="center">Stok Fisik</th>
                <th class="center">Selisih</th>
                <th>Petugas</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $stockOpnames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opname): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="center"><?php echo e($loop->iteration); ?></td>
                    <td>
                        <?php echo e($opname->opname_date
                            ? \Carbon\Carbon::parse($opname->opname_date)->format('d/m/Y')
                            : '-'); ?>

                    </td>
                    <td><?php echo e($opname->product->name ?? '-'); ?></td>
                    <td class="center"><?php echo e($opname->system_stock); ?></td>
                    <td class="center"><?php echo e($opname->physical_stock); ?></td>
                    <td class="center"><?php echo e($opname->difference); ?></td>
                    <td><?php echo e($opname->user->name ?? '-'); ?></td>
                    <td><?php echo e($opname->note ?? '-'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="8" class="center">Belum ada data stock opname.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak melalui Sistem Informasi Stockify
    </div>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\stockify\resources\views/reports/pdf.blade.php ENDPATH**/ ?>