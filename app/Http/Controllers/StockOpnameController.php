<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockOpname;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockOpnameController extends Controller
{
    /**
     * Menampilkan daftar stock opname.
     */
    public function index()
    {
        $stockOpnames = StockOpname::with(['product', 'user'])
            ->latest('opname_date')
            ->latest()
            ->get();

        $products = Product::orderBy('name')->get();

        return view('stock-opnames.index', compact(
            'stockOpnames',
            'products'
        ));
    }

    /**
     * Menyimpan stock opname baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'physical_stock' => 'required|integer|min:0',
            'note' => 'nullable|string',
            'opname_date' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {

            $product = Product::lockForUpdate()
                ->findOrFail($request->product_id);

            $systemStock = $product->stock;
            $physicalStock = $request->physical_stock;

            $difference = $physicalStock - $systemStock;

            StockOpname::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'system_stock' => $systemStock,
                'physical_stock' => $physicalStock,
                'difference' => $difference,
                'note' => $request->note,
                'opname_date' => $request->opname_date,
            ]);

            $product->update([
                'stock' => $physicalStock,
            ]);
        });

        return redirect()
            ->route('stock-opnames.index')
            ->with('success', 'Stock opname berhasil disimpan dan stok produk telah disesuaikan.');
    }
}