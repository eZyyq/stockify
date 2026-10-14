
@extends('layouts.admin')

@section('content')

<div id="reports-page">

    <style>
        #reports-page {
            color: #1f2937;
        }

        #reports-page .report-panel {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 3px 10px rgba(15, 23, 42, .04);
        }

        #reports-page .report-muted {
            color: #6b7280;
        }

        #reports-page .report-stat {
            border-radius: 13px;
            padding: 20px;
            border: 1px solid #e5e7eb;
        }

        #reports-page .report-table-wrap {
            overflow-x: auto;
            width: 100%;
        }

        #reports-page table {
            width: 100%;
            border-collapse: collapse;
        }

        #reports-page table thead th {
            background: #1d4ed8;
            color: #ffffff;
            padding: 14px 16px;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        #reports-page table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        #reports-page table tbody tr:hover {
            background: #f8fafc;
        }

        #reports-page input,
        #reports-page select {
            width: 100%;
            min-width: 0;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            padding: 10px 12px;
            background: #ffffff;
            color: #111827;
            font-size: 14px;
        }

        #reports-page input:focus,
        #reports-page select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
        }

        #reports-page .report-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 9px;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s;
            white-space: nowrap;
        }

        #reports-page .report-chart {
            position: relative;
            width: 100%;
            height: 350px;
        }

        #reports-page canvas {
            max-width: 100%;
        }

        /* MODE GELAP */
        html.theme-dark #reports-page {
            color: #e5e7eb;
        }

        html.theme-dark #reports-page .report-panel,
        html.theme-dark #reports-page .bg-white {
            background-color: #1f2937;
            border-color: #374151;
        }

        html.theme-dark #reports-page .report-muted,
        html.theme-dark #reports-page .text-gray-500,
        html.theme-dark #reports-page .text-gray-600 {
            color: #cbd5e1;
        }

        html.theme-dark #reports-page .text-gray-800,
        html.theme-dark #reports-page .text-gray-700 {
            color: #f3f4f6;
        }

        html.theme-dark #reports-page .report-stat,
        html.theme-dark #reports-page .bg-gray-50 {
            background-color: #273449;
            border-color: #374151;
        }

        html.theme-dark #reports-page .bg-blue-50 {
            background-color: #172554;
            border-color: #1e40af;
        }

        html.theme-dark #reports-page .bg-green-50 {
            background-color: #052e16;
            border-color: #166534;
        }

        html.theme-dark #reports-page .bg-orange-50 {
            background-color: #431407;
            border-color: #9a3412;
        }

        html.theme-dark #reports-page .bg-purple-50 {
            background-color: #3b0764;
            border-color: #6b21a8;
        }

        html.theme-dark #reports-page .bg-yellow-50 {
            background-color: #422006;
            border-color: #854d0e;
        }

        html.theme-dark #reports-page table tbody tr {
            background-color: #1f2937;
        }

        html.theme-dark #reports-page table tbody tr:hover {
            background-color: #273449;
        }

        html.theme-dark #reports-page table tbody td {
            color: #e5e7eb;
            border-color: #374151;
        }

        html.theme-dark #reports-page input,
        html.theme-dark #reports-page select {
            background-color: #111827;
            color: #f9fafb;
            border-color: #4b5563;
        }

        html.theme-dark #reports-page .bg-gray-200 {
            background-color: #374151;
            color: #f9fafb;
        }

        html.theme-dark #reports-page .text-blue-600 {
            color: #93c5fd;
        }

        html.theme-dark #reports-page .text-green-600 {
            color: #86efac;
        }

        html.theme-dark #reports-page .text-orange-600 {
            color: #fdba74;
        }

        html.theme-dark #reports-page .text-purple-600 {
            color: #d8b4fe;
        }

        html.theme-dark #reports-page .text-yellow-600 {
            color: #fde68a;
        }

        html.theme-dark #reports-page .text-green-700 {
            color: #86efac;
        }

        html.theme-dark #reports-page .text-red-700 {
            color: #fca5a5;
        }

        html.theme-dark #reports-page .bg-blue-50.text-blue-800 {
            color: #dbeafe;
        }

        @media (max-width: 640px) {
            #reports-page .report-panel {
                padding: 16px;
            }

            #reports-page .report-chart {
                height: 280px;
            }

            #reports-page table thead th,
            #reports-page table tbody td {
                padding: 12px;
            }
        }
    </style>

    {{-- HEADER --}}
    <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 sm:text-3xl">
                Laporan
            </h1>
            <p class="report-muted mt-1 text-sm">
                Ringkasan dan pemantauan persediaan barang Stockify.
            </p>
        </div>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('reports.export.excel', request()->only('type', 'start_date', 'end_date')) }}"
               class="report-btn bg-green-600 text-white hover:bg-green-700">
                <span>↓</span> Ekspor Excel
            </a>

            <a href="{{ route('reports.export.pdf', request()->only('type', 'start_date', 'end_date')) }}"
               class="report-btn bg-red-600 text-white hover:bg-red-700">
                <span>↓</span> Ekspor PDF
            </a>
        </div>
    </div>

    {{-- RINGKASAN --}}
    <div class="report-panel">
        <div class="mb-5">
            <h2 class="text-xl font-bold text-gray-800">Ringkasan Laporan</h2>
            <p class="report-muted mt-1 text-sm">
                Ikhtisar kondisi stok dan aktivitas persediaan.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">

            <div class="report-stat bg-gray-50">
                <p class="report-muted text-sm">Total Produk</p>
                <h3 class="mt-2 text-3xl font-bold text-gray-800">
                    {{ $totalProducts }}
                </h3>
                <p class="report-muted mt-2 text-xs">Produk terdaftar</p>
            </div>

            <div class="report-stat bg-blue-50">
                <p class="report-muted text-sm">Total Stok Tersedia</p>
                <h3 class="mt-2 text-3xl font-bold text-blue-600">
                    {{ $totalStock }}
                </h3>
                <p class="report-muted mt-2 text-xs">Unit persediaan</p>
            </div>

            <div class="report-stat bg-green-50">
                <p class="report-muted text-sm">Total Barang Masuk</p>
                <h3 class="mt-2 text-3xl font-bold text-green-600">
                    {{ $totalIn }}
                </h3>
                <p class="report-muted mt-2 text-xs">Unit barang masuk</p>
            </div>

            <div class="report-stat bg-orange-50">
                <p class="report-muted text-sm">Total Barang Keluar</p>
                <h3 class="mt-2 text-3xl font-bold text-orange-600">
                    {{ $totalOut }}
                </h3>
                <p class="report-muted mt-2 text-xs">Unit barang keluar</p>
            </div>

            <div class="report-stat bg-purple-50">
                <p class="report-muted text-sm">Total Stock Opname</p>
                <h3 class="mt-2 text-3xl font-bold text-purple-600">
                    {{ $totalStockOpnames }}
                </h3>
                <p class="report-muted mt-2 text-xs">Pemeriksaan tercatat</p>
            </div>

            <div class="report-stat bg-yellow-50">
                <p class="report-muted text-sm">Total Selisih Opname</p>
                <h3 class="mt-2 text-3xl font-bold text-yellow-600">
                    {{ $totalDifference }}
                </h3>
                <p class="report-muted mt-2 text-xs">Akumulasi selisih stok</p>
            </div>

        </div>
    </div>

    {{-- GRAFIK BARANG MASUK DAN KELUAR --}}
    <div class="report-panel">
        <div class="mb-5">
            <h2 class="text-xl font-bold text-gray-800">
                Grafik Barang Masuk dan Keluar
            </h2>
            <p class="report-muted mt-1 text-sm">
                Perbandingan jumlah transaksi berdasarkan tanggal.
            </p>
        </div>

        <div class="report-chart">
            <canvas id="transactionChart"></canvas>
        </div>
    </div>

    {{-- GRAFIK STOK PRODUK --}}
    <div class="report-panel">
        <div class="mb-5">
            <h2 class="text-xl font-bold text-gray-800">Grafik Stok Produk</h2>
            <p class="report-muted mt-1 text-sm">
                Perbandingan jumlah stok untuk setiap produk.
            </p>
        </div>

        @if (count($stockChartLabels) > 0)
            <div class="report-chart">
                <canvas id="stockChart"></canvas>
            </div>
        @else
            <div class="py-10 text-center">
                <p class="report-muted">Belum ada data produk untuk ditampilkan.</p>
            </div>
        @endif
    </div>

    {{-- GRAFIK STOCK OPNAME --}}
    <div class="report-panel">
        <div class="mb-5">
            <h2 class="text-xl font-bold text-gray-800">Grafik Stock Opname</h2>
            <p class="report-muted mt-1 text-sm">
                Perbandingan penambahan dan pengurangan stok berdasarkan tanggal pemeriksaan.
            </p>
        </div>

        <div class="report-chart">
            <canvas id="opnameChart"></canvas>
        </div>
    </div>

    {{-- DAFTAR STOK PRODUK --}}
    <div class="report-panel">
        <div class="mb-5">
            <h2 class="text-xl font-bold text-gray-800">Daftar Stok Produk</h2>
            <p class="report-muted mt-1 text-sm">
                Daftar produk dan jumlah persediaan saat ini.
            </p>
        </div>

        <div class="report-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th class="text-center">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-semibold">{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td class="text-center">
                                @if ($product->stock <= 5)
                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        {{ $product->stock }}
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        {{ $product->stock }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center report-muted">
                                Belum ada data produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- LAPORAN STOCK OPNAME --}}
    <div class="report-panel">
        <div class="mb-5">
            <h2 class="text-xl font-bold text-gray-800">Laporan Stock Opname</h2>
            <p class="report-muted mt-1 text-sm">
                Riwayat pemeriksaan dan penyesuaian stok produk.
            </p>
        </div>

        <div class="report-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th class="text-center">Stok Sistem</th>
                        <th class="text-center">Stok Fisik</th>
                        <th class="text-center">Selisih</th>
                        <th>Petugas</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stockOpnames as $opname)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap">
                                {{ $opname->opname_date->format('d/m/Y') }}
                            </td>
                            <td class="font-semibold">
                                {{ $opname->product->name ?? '-' }}
                            </td>
                            <td class="text-center">{{ $opname->system_stock }}</td>
                            <td class="text-center">{{ $opname->physical_stock }}</td>
                            <td class="text-center">
                                @if ($opname->difference > 0)
                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        +{{ $opname->difference }}
                                    </span>
                                @elseif ($opname->difference < 0)
                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        {{ $opname->difference }}
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                        0
                                    </span>
                                @endif
                            </td>
                            <td>{{ $opname->user->name ?? '-' }}</td>
                            <td>{{ $opname->note ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 text-center report-muted">
                                Belum ada data stock opname.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- LAPORAN TRANSAKSI DAN FILTER --}}
    <div class="report-panel">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-800">Laporan Transaksi</h2>
            <p class="report-muted mt-1 text-sm">
                Riwayat barang masuk dan barang keluar.
            </p>
        </div>

        {{-- FILTER --}}
        <form method="GET" action="{{ route('reports.index') }}" class="mb-5">
            <div class="grid grid-cols-1 items-end gap-4 sm:grid-cols-2 xl:grid-cols-4">

                <div>
                    <label for="report-type" class="mb-2 block text-sm font-medium">
                        Jenis Transaksi
                    </label>
                    <select id="report-type" name="type">
                        <option value="" {{ request('type') == '' ? 'selected' : '' }}>
                            Semua Transaksi
                        </option>
                        <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>
                            Barang Masuk
                        </option>
                        <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>
                            Barang Keluar
                        </option>
                    </select>
                </div>

                <div>
                    <label for="start-date" class="mb-2 block text-sm font-medium">
                        Tanggal Mulai
                    </label>
                    <input
                        id="start-date"
                        type="date"
                        name="start_date"
                        value="{{ request('start_date') }}"
                    >
                </div>

                <div>
                    <label for="end-date" class="mb-2 block text-sm font-medium">
                        Tanggal Akhir
                    </label>
                    <input
                        id="end-date"
                        type="date"
                        name="end_date"
                        value="{{ request('end_date') }}"
                    >
                </div>

                <div class="flex flex-wrap gap-2">
                    <button type="submit"
                            class="report-btn bg-blue-600 text-white hover:bg-blue-700">
                        Terapkan
                    </button>

                    <a href="{{ route('reports.index') }}"
                       class="report-btn bg-gray-200 text-gray-700 hover:bg-gray-300">
                        Reset
                    </a>
                </div>

            </div>
        </form>

        {{-- INFORMASI FILTER AKTIF --}}
        @if (request('type') || request('start_date') || request('end_date'))
            <div class="mb-5 rounded-xl border border-blue-200 bg-blue-50 p-4 text-sm text-blue-800">
                <p class="mb-2 font-bold">Filter Laporan Aktif</p>

                <p>
                    Jenis transaksi:
                    @if (request('type') == 'in')
                        Barang Masuk
                    @elseif (request('type') == 'out')
                        Barang Keluar
                    @else
                        Semua Transaksi
                    @endif
                </p>

                <p>
                    Tanggal mulai: {{ request('start_date') ?: 'Tidak dibatasi' }}
                </p>

                <p>
                    Tanggal akhir: {{ request('end_date') ?: 'Tidak dibatasi' }}
                </p>
            </div>
        @endif

        {{-- TABEL TRANSAKSI --}}
        <div class="report-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Produk</th>
                        <th class="text-center">Jenis</th>
                        <th class="text-center">Jumlah</th>
                        <th>Supplier</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-semibold">
                                {{ $transaction->product->name ?? '-' }}
                            </td>
                            <td class="text-center">
                                @if ($transaction->type == 'in')
                                    <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                        Barang Masuk
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        Barang Keluar
                                    </span>
                                @endif
                            </td>
                            <td class="text-center font-semibold">
                                {{ $transaction->quantity }}
                            </td>
                            <td>{{ $transaction->supplier->name ?? '-' }}</td>
                            <td class="whitespace-nowrap">
                                {{ $transaction->transaction_date }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center report-muted">
                                Belum ada data transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- GRAFIK --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Chart === 'undefined') {
        console.error('Chart.js belum tersedia. Periksa pemuatan Chart.js pada layout.');
        return;
    }

    const transactionCanvas = document.getElementById('transactionChart');

    if (transactionCanvas) {
        new Chart(transactionCanvas, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [
                    {
                        label: 'Barang Masuk',
                        data: @json($chartIn),
                        backgroundColor: '#16a34a',
                        borderRadius: 5
                    },
                    {
                        label: 'Barang Keluar',
                        data: @json($chartOut),
                        backgroundColor: '#ea580c',
                        borderRadius: 5
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Barang'
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    }
                }
            }
        });
    }

    const stockCanvas = document.getElementById('stockChart');

    if (stockCanvas) {
        new Chart(stockCanvas, {
            type: 'bar',
            data: {
                labels: @json($stockChartLabels),
                datasets: [{
                    label: 'Jumlah Stok',
                    data: @json($stockChartData),
                    backgroundColor: '#2563eb',
                    borderRadius: 5
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Stok'
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Nama Produk'
                        }
                    }
                }
            }
        });
    }

    const opnameCanvas = document.getElementById('opnameChart');

    if (opnameCanvas) {
        new Chart(opnameCanvas, {
            type: 'bar',
            data: {
                labels: @json($opnameChartLabels),
                datasets: [
                    {
                        label: 'Penambahan Stok',
                        data: @json($opnameChartIn),
                        backgroundColor: '#16a34a',
                        borderRadius: 5
                    },
                    {
                        label: 'Pengurangan Stok',
                        data: @json($opnameChartOut),
                        backgroundColor: '#dc2626',
                        borderRadius: 5
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Selisih Stok'
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal Stock Opname'
                        }
                    }
                }
            }
        });
    }
});
</script>

@endsection
