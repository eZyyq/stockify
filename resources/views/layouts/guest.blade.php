<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Stockify</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">

    <div class="flex min-h-screen items-center justify-center bg-gray-100 px-4">

        <div class="w-full max-w-md">

            <div class="mb-6 text-center">

                <a href="/" class="inline-block">
                    <h1 class="text-3xl font-bold text-blue-700">
                        STOCKIFY
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Sistem Manajemen Stok Barang
                    </p>
                </a>

            </div>

            <div class="overflow-hidden rounded-xl bg-white p-6 shadow-lg">

                {{ $slot }}

            </div>

            <p class="mt-5 text-center text-xs text-gray-400">
                Stockify &copy; {{ date('Y') }}
            </p>

        </div>

    </div>

</body>

</html>