<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['product', 'supplier'])
            ->latest()
            ->get();

        $products = Product::all();
        $suppliers = Supplier::all();

        return view('transactions.index', compact(
            'transactions',
            'products',
            'suppliers'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable',
            'transaction_date' => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Barang keluar
        if ($request->type == 'out') {

            if ($product->stock < $request->quantity) {
                return back()
                    ->withInput()
                    ->with('error', 'Stok produk tidak mencukupi.');
            }

            $product->stock -= $request->quantity;

        } else {

            // Barang masuk
            $product->stock += $request->quantity;
        }

        $product->save();

        Transaction::create([
            'product_id' => $request->product_id,
            'supplier_id' => $request->supplier_id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(Transaction $transaction)
    {
        $products = Product::all();
        $suppliers = Supplier::all();

        return view('transactions.edit', compact(
            'transaction',
            'products',
            'suppliers'
        ));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable',
            'transaction_date' => 'required|date',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Ambil data produk
        |--------------------------------------------------------------------------
        */

        $oldProductId = $transaction->product_id;
        $newProductId = $request->product_id;

        /*
        |--------------------------------------------------------------------------
        | Jika produk TIDAK berubah
        |--------------------------------------------------------------------------
        */

        if ($oldProductId == $newProductId) {

            $product = Product::findOrFail($oldProductId);

            /*
            |--------------------------------------------------------------------------
            | 1. Kembalikan efek transaksi lama
            |--------------------------------------------------------------------------
            */

            if ($transaction->type == 'in') {
                $product->stock -= $transaction->quantity;
            } else {
                $product->stock += $transaction->quantity;
            }

            /*
            |--------------------------------------------------------------------------
            | 2. Cek apakah transaksi baru valid
            |--------------------------------------------------------------------------
            */

            if ($request->type == 'out') {

                if ($product->stock < $request->quantity) {

                    // Kembalikan stok ke kondisi sebelum proses edit
                    if ($transaction->type == 'in') {
                        $product->stock += $transaction->quantity;
                    } else {
                        $product->stock -= $transaction->quantity;
                    }

                    $product->save();

                    return back()
                        ->withInput()
                        ->with('error', 'Stok produk tidak mencukupi.');
                }
            }

            /*
            |--------------------------------------------------------------------------
            | 3. Terapkan transaksi baru
            |--------------------------------------------------------------------------
            */

            if ($request->type == 'in') {
                $product->stock += $request->quantity;
            } else {
                $product->stock -= $request->quantity;
            }

            $product->save();
        }

        /*
        |--------------------------------------------------------------------------
        | Jika produk BERUBAH
        |--------------------------------------------------------------------------
        */

        else {

            $oldProduct = Product::findOrFail($oldProductId);
            $newProduct = Product::findOrFail($newProductId);

            /*
            |--------------------------------------------------------------------------
            | 1. Kembalikan stok produk lama
            |--------------------------------------------------------------------------
            */

            if ($transaction->type == 'in') {
                $oldProduct->stock -= $transaction->quantity;
            } else {
                $oldProduct->stock += $transaction->quantity;
            }

            $oldProduct->save();

            /*
            |--------------------------------------------------------------------------
            | 2. Cek stok produk baru
            |--------------------------------------------------------------------------
            */

            if ($request->type == 'out') {

                if ($newProduct->stock < $request->quantity) {

                    return back()
                        ->withInput()
                        ->with('error', 'Stok produk tidak mencukupi.');
                }
            }

            /*
            |--------------------------------------------------------------------------
            | 3. Terapkan transaksi baru ke produk baru
            |--------------------------------------------------------------------------
            */

            if ($request->type == 'in') {
                $newProduct->stock += $request->quantity;
            } else {
                $newProduct->stock -= $request->quantity;
            }

            $newProduct->save();
        }

        /*
        |--------------------------------------------------------------------------
        | Update data transaksi
        |--------------------------------------------------------------------------
        */

        $transaction->update([
            'product_id' => $request->product_id,
            'supplier_id' => $request->supplier_id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
        $product = $transaction->product;

        if ($transaction->type == 'in') {
            $product->stock -= $transaction->quantity;
        } else {
            $product->stock += $transaction->quantity;
        }

        $product->save();

        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}