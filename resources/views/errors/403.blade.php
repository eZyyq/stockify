<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Akses Ditolak - Stockify</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100">

    <div class="flex min-h-screen items-center justify-center px-6">

        <div class="w-full max-w-lg text-center">

            {{-- Logo --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-blue-700">
                    STOCKIFY
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Sistem Manajemen Stok Barang
                </p>
            </div>

            {{-- Card Error --}}
            <div class="rounded-2xl bg-white p-8 shadow-lg">

                {{-- Icon --}}
                <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-red-100">

                    <svg
                        class="h-10 w-10 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"
                        />
                    </svg>

                </div>

                {{-- 403 --}}
                <h2 class="text-6xl font-bold text-gray-800">
                    403
                </h2>

                <h3 class="mt-4 text-2xl font-semibold text-gray-900">
                    Akses Ditolak
                </h3>

                <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-gray-500">
                    Maaf, akun Anda tidak memiliki izin untuk mengakses
                    halaman ini.
                </p>

                <p class="mt-2 text-xs text-gray-400">
                    Silakan kembali ke halaman sebelumnya atau gunakan menu
                    yang tersedia sesuai dengan role akun Anda.
                </p>

                {{-- Buttons --}}
                <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">

                    <button
                        onclick="history.back()"
                        class="rounded-lg bg-gray-200 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-300"
                    >
                        Kembali
                    </button>

                    <a
                        href="{{ url('/products') }}"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700"
                    >
                        Ke Produk
                    </a>

                </div>

            </div>

            {{-- Footer --}}
            <p class="mt-6 text-xs text-gray-400">
                Stockify &copy; {{ date('Y') }}
            </p>

        </div>

    </div>

</body>

</html>