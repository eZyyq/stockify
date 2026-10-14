<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Stockify - Sistem Manajemen Stok</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="min-h-screen bg-gray-100">

    <!-- Navbar -->
    <nav class="border-b border-gray-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

            <div>
                <h1 class="text-2xl font-bold text-blue-700">
                    STOCKIFY
                </h1>

                <p class="text-xs text-gray-500">
                    Sistem Manajemen Stok Barang
                </p>
            </div>

            <div class="flex items-center gap-3">

                <a href="<?php echo e(route('login')); ?>"
                    class="rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
                    Masuk
                </a>

                <a href="<?php echo e(route('register')); ?>"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700">
                    Daftar
                </a>

            </div>

        </div>
    </nav>


    <!-- Hero -->
    <section class="mx-auto max-w-7xl px-6 py-20">

        <div class="mx-auto max-w-3xl text-center">

            <div class="mb-5 inline-block rounded-full bg-blue-100 px-4 py-2 text-sm font-medium text-blue-700">
                Sistem Manajemen Gudang
            </div>

            <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                Kelola Stok Barang
                <span class="text-blue-600">
                    Lebih Mudah
                </span>
            </h2>

            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-600">
                Stockify membantu mengelola produk, stok, transaksi barang,
                dan laporan gudang dalam satu sistem.
            </p>

            <div class="mt-8 flex justify-center gap-3">

                <a href="<?php echo e(route('login')); ?>"
                    class="rounded-lg bg-blue-600 px-6 py-3 text-sm font-medium text-white shadow-sm hover:bg-blue-700">
                    Mulai Menggunakan
                </a>

                <a href="#fitur"
                    class="rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Lihat Fitur
                </a>

            </div>

        </div>

    </section>


    <!-- Fitur -->
    <section id="fitur" class="bg-white py-16">

        <div class="mx-auto max-w-7xl px-6">

            <div class="mb-10 text-center">

                <h3 class="text-3xl font-bold text-gray-900">
                    Fitur Stockify
                </h3>

                <p class="mt-2 text-gray-500">
                    Beberapa fitur utama yang tersedia dalam sistem.
                </p>

            </div>


            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

                <!-- Produk -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-xl">
                        📦
                    </div>

                    <h4 class="text-lg font-semibold text-gray-900">
                        Manajemen Produk
                    </h4>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Mengelola data produk, kategori, supplier, harga, dan stok.
                    </p>
                </div>


                <!-- Transaksi -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-green-100 text-xl">
                        🔄
                    </div>

                    <h4 class="text-lg font-semibold text-gray-900">
                        Transaksi Stok
                    </h4>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Mencatat transaksi barang masuk dan barang keluar dengan mudah.
                    </p>
                </div>


                <!-- Laporan -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-yellow-100 text-xl">
                        📊
                    </div>

                    <h4 class="text-lg font-semibold text-gray-900">
                        Laporan
                    </h4>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Melihat informasi stok dan riwayat transaksi dalam bentuk laporan.
                    </p>
                </div>


                <!-- Pengguna -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-purple-100 text-xl">
                        👥
                    </div>

                    <h4 class="text-lg font-semibold text-gray-900">
                        Manajemen Pengguna
                    </h4>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Mengatur pengguna berdasarkan role Admin, Manager, dan Staff.
                    </p>
                </div>

            </div>

        </div>

    </section>


    <!-- Footer -->
    <footer class="border-t border-gray-200 bg-gray-50 py-6">

        <div class="mx-auto max-w-7xl px-6 text-center">

            <p class="text-sm text-gray-500">
                Stockify &copy; <?php echo e(date('Y')); ?>

            </p>

            <p class="mt-1 text-xs text-gray-400">
                Sistem Manajemen Stok Barang
            </p>

        </div>

    </footer>

</body>

</html><?php /**PATH C:\xampp\htdocs\stockify\resources\views/welcome.blade.php ENDPATH**/ ?>