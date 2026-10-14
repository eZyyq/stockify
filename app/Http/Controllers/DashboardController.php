<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\StockOpname;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total produk
        $totalProducts = Product::count();

        // Produk dengan stok rendah
        $lowStockProducts = Product::where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->get();

            // Ringkasan kondisi stok produk
$totalOutOfStock = Product::where('stock', '<=', 0)->count();

$totalLowStock = Product::where('stock', '>', 0)
    ->where('stock', '<=', 5)
    ->count();

$totalSafeStock = Product::where('stock', '>', 5)->count();

        // Total transaksi masuk
        $totalIncoming = Transaction::where('type', 'in')
            ->sum('quantity');

        // Total transaksi keluar
        $totalOutgoing = Transaction::where('type', 'out')
            ->sum('quantity');

        // Total stock opname
        $totalStockOpnames = StockOpname::count();

        // Stock opname terbaru
        $latestStockOpnames = StockOpname::with(['product', 'user'])
            ->latest('opname_date')
            ->latest()
            ->take(5)
            ->get();

        // Transaksi terbaru
        $latestTransactions = Transaction::with(['product', 'supplier'])
            ->latest('transaction_date')
            ->latest()
            ->take(5)
            ->get();

        // Data grafik transaksi selama 7 hari terakhir
        $today = Carbon::today();
        $startDate = $today->copy()->subDays(29);


        $chartTransactions = Transaction::query()
            ->whereBetween('transaction_date', [
                $startDate->toDateString(),
                $today->toDateString(),
            ])
            ->get(['transaction_date', 'type', 'quantity']);

        $chartLabels = [];
        $chartIncoming = [];
        $chartOutgoing = [];

        for ($i = 0; $i < 30; $i++) {
            $date = $startDate->copy()->addDays($i);

            $dailyTransactions = $chartTransactions->filter(
                function ($transaction) use ($date) {
                    return Carbon::parse($transaction->transaction_date)
                        ->toDateString() === $date->toDateString();
                }
            );

            $chartLabels[] = $date->format('d/m');

            $chartIncoming[] = (int) $dailyTransactions
                ->where('type', 'in')
                ->sum('quantity');

            $chartOutgoing[] = (int) $dailyTransactions
                ->where('type', 'out')
                ->sum('quantity');
        }


        return view('dashboard', compact(
            'totalProducts',
            'lowStockProducts',
            'totalIncoming',
            'totalOutgoing',
            'totalStockOpnames',
            'latestStockOpnames',
            'latestTransactions',
            'chartLabels',
            'chartIncoming',
            'chartOutgoing',
            'totalOutOfStock',
            'totalLowStock',
            'totalSafeStock',
        ));
    }
}
