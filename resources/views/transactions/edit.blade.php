@extends('layouts.admin')

@section('content')

<h1 style="font-size:24px; font-weight:bold; margin-bottom:20px;">
    Edit Transaksi
</h1>

<div style="background:white; padding:24px; border-radius:10px; max-width:700px;">

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom:15px;">
            <label>Produk</label>

            <select name="product_id"
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;"
                    required>

                @foreach($products as $product)
                    <option value="{{ $product->id }}"
                        {{ $transaction->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} (Stok: {{ $product->stock }})
                    </option>
                @endforeach

            </select>
        </div>

        <div style="margin-bottom:15px;">
            <label>Supplier</label>

            <select name="supplier_id"
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">

                <option value="">-- Pilih Supplier --</option>

                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}"
                        {{ $transaction->supplier_id == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div style="margin-bottom:15px;">
            <label>Tipe Transaksi</label>

            <select name="type"
                    style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;"
                    required>

                <option value="in" {{ $transaction->type == 'in' ? 'selected' : '' }}>
                    Barang Masuk
                </option>

                <option value="out" {{ $transaction->type == 'out' ? 'selected' : '' }}>
                    Barang Keluar
                </option>

            </select>
        </div>

        <div style="margin-bottom:15px;">
            <label>Jumlah</label>

            <input type="number"
                   name="quantity"
                   value="{{ $transaction->quantity }}"
                   min="1"
                   required
                   style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
        </div>

        <div style="margin-bottom:15px;">
            <label>Tanggal Transaksi</label>

            <input type="date"
                   name="transaction_date"
                   value="{{ $transaction->transaction_date }}"
                   required
                   style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
        </div>

        <div style="margin-bottom:20px;">
            <label>Keterangan</label>

            <textarea name="description"
                      rows="4"
                      style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">{{ $transaction->description }}</textarea>
        </div>

        <button type="submit"
                style="background:#2563eb; color:white; padding:10px 18px; border:none; border-radius:6px; cursor:pointer;">
            Simpan Perubahan
        </button>

        <a href="{{ route('transactions.index') }}"
           style="margin-left:10px; color:#555; text-decoration:none;">
            Batal
        </a>

    </form>

</div>

@endsection