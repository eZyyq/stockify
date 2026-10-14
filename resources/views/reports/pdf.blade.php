
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
        Tanggal cetak: {{ now()->format('d/m/Y H:i') }}
    </p>

    {{-- LAPORAN STOK PRODUK --}}
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
            @forelse ($products as $product)
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td class="center">{{ $product->stock }}</td>
                    <td>{{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                    <td>{{ number_format($product->selling_price, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="center">Belum ada data produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- LAPORAN TRANSAKSI --}}
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
            @forelse ($transactions as $transaction)
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>
                        {{ $transaction->transaction_date
                            ? \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y')
                            : '-' }}
                    </td>
                    <td>{{ $transaction->product->name ?? '-' }}</td>
                    <td>
                        {{ $transaction->type === 'in'
                            ? 'Barang Masuk'
                            : 'Barang Keluar' }}
                    </td>
                    <td class="center">{{ $transaction->quantity }}</td>
                    <td>{{ $transaction->supplier->name ?? '-' }}</td>
                    <td>{{ $transaction->description ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="center">Belum ada data transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- LAPORAN STOCK OPNAME --}}
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
            @forelse ($stockOpnames as $opname)
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>
                        {{ $opname->opname_date
                            ? \Carbon\Carbon::parse($opname->opname_date)->format('d/m/Y')
                            : '-' }}
                    </td>
                    <td>{{ $opname->product->name ?? '-' }}</td>
                    <td class="center">{{ $opname->system_stock }}</td>
                    <td class="center">{{ $opname->physical_stock }}</td>
                    <td class="center">{{ $opname->difference }}</td>
                    <td>{{ $opname->user->name ?? '-' }}</td>
                    <td>{{ $opname->note ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="center">Belum ada data stock opname.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak melalui Sistem Informasi Stockify
    </div>

</body>
</html>
