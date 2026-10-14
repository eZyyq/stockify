<?php

namespace App\Http\Controllers;

use App\Exports\StockifyReportExport;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\StockOpname;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // FILTER LAPORAN
        $filters = $this->validatedFilters($request);

        $type = $filters['type'];
        $startDate = $filters['start_date'];
        $endDate = $filters['end_date'];

        // RINGKASAN STOK SAAT INI
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');

        $products = Product::with('category')
            ->latest()
            ->get();

        // DATA GRAFIK STOK PRODUK
        $stockChartProducts = Product::orderBy('stock', 'desc')
            ->get(['name', 'stock']);

        $stockChartLabels = $stockChartProducts->pluck('name');
        $stockChartData = $stockChartProducts->pluck('stock');

        // FILTER TRANSAKSI
        $transactionQuery = Transaction::with([
            'product',
            'supplier',
        ])->latest('transaction_date')->latest();

        $this->applyDateFilter(
            $transactionQuery,
            'transaction_date',
            $startDate,
            $endDate
        );

        if ($type) {
            $transactionQuery->where('type', $type);
        }

        $transactions = $transactionQuery->get();

        // TOTAL BARANG MASUK DAN KELUAR
        $totalInQuery = Transaction::where('type', 'in');
        $totalOutQuery = Transaction::where('type', 'out');

        $this->applyDateFilter(
            $totalInQuery,
            'transaction_date',
            $startDate,
            $endDate
        );

        $this->applyDateFilter(
            $totalOutQuery,
            'transaction_date',
            $startDate,
            $endDate
        );

        $totalIn = $totalInQuery->sum('quantity');
        $totalOut = $totalOutQuery->sum('quantity');

        // DATA GRAFIK TRANSAKSI
        // Grafik tetap menampilkan kedua jenis transaksi
        // meskipun filter jenis dipakai pada tabel.
        $chartQuery = Transaction::query();

        $this->applyDateFilter(
            $chartQuery,
            'transaction_date',
            $startDate,
            $endDate
        );

        $chartTransactions = $chartQuery
            ->selectRaw('DATE(transaction_date) as tanggal')
            ->selectRaw(
                "SUM(CASE WHEN type = 'in' THEN quantity ELSE 0 END) as barang_masuk"
            )
            ->selectRaw(
                "SUM(CASE WHEN type = 'out' THEN quantity ELSE 0 END) as barang_keluar"
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $chartLabels = $chartTransactions->pluck('tanggal');
        $chartIn = $chartTransactions->pluck('barang_masuk');
        $chartOut = $chartTransactions->pluck('barang_keluar');

        // FILTER STOCK OPNAME
        $opnameQuery = StockOpname::query();

        $this->applyDateFilter(
            $opnameQuery,
            'opname_date',
            $startDate,
            $endDate
        );

        $totalStockOpnames = (clone $opnameQuery)->count();
        $totalDifference = (clone $opnameQuery)->sum('difference');

        $stockOpnames = (clone $opnameQuery)
            ->with(['product', 'user'])
            ->latest('opname_date')
            ->latest()
            ->get();

        // DATA GRAFIK STOCK OPNAME
        $opnameChartQuery = StockOpname::query();

        $this->applyDateFilter(
            $opnameChartQuery,
            'opname_date',
            $startDate,
            $endDate
        );

        $opnameChartData = $opnameChartQuery
            ->selectRaw('DATE(opname_date) as tanggal')
            ->selectRaw(
                'SUM(CASE WHEN difference > 0 THEN difference ELSE 0 END) as penambahan'
            )
            ->selectRaw(
                'SUM(CASE WHEN difference < 0 THEN ABS(difference) ELSE 0 END) as pengurangan'
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $opnameChartLabels = $opnameChartData->pluck('tanggal');
        $opnameChartIn = $opnameChartData->pluck('penambahan');
        $opnameChartOut = $opnameChartData->pluck('pengurangan');

        // TAMPILKAN HALAMAN LAPORAN
        return view('reports.index', compact(
            'totalProducts',
            'totalStock',
            'totalIn',
            'totalOut',
            'products',
            'transactions',
            'totalStockOpnames',
            'totalDifference',
            'stockOpnames',
            'type',
            'startDate',
            'endDate',
            'chartLabels',
            'chartIn',
            'chartOut',
            'stockChartLabels',
            'stockChartData',
            'opnameChartLabels',
            'opnameChartIn',
            'opnameChartOut'
        ));
    }

    public function exportExcel(Request $request)
    {
        $filters = $this->validatedFilters($request);

        $filename = 'laporan-stockify-'
            . now()->format('Y-m-d-His')
            . '.xlsx';

        return Excel::download(
            new StockifyReportExport(
                $filters['type'],
                $filters['start_date'],
                $filters['end_date']
            ),
            $filename
        );
    }

    public function exportPdf(Request $request)
    {
        $filters = $this->validatedFilters($request);

        $type = $filters['type'];
        $startDate = $filters['start_date'];
        $endDate = $filters['end_date'];

        // STOK PRODUK SAAT INI
        $products = Product::with('category')
            ->orderBy('name')
            ->get();

        // TRANSAKSI SESUAI FILTER
        $transactionQuery = Transaction::with([
            'product',
            'supplier',
        ])->latest('transaction_date')->latest();

        $this->applyDateFilter(
            $transactionQuery,
            'transaction_date',
            $startDate,
            $endDate
        );

        if ($type) {
            $transactionQuery->where('type', $type);
        }

        $transactions = $transactionQuery->get();

        // STOCK OPNAME SESUAI FILTER
        $opnameQuery = StockOpname::query();

        $this->applyDateFilter(
            $opnameQuery,
            'opname_date',
            $startDate,
            $endDate
        );

        $stockOpnames = $opnameQuery
            ->with(['product', 'user'])
            ->latest('opname_date')
            ->latest()
            ->get();

        $pdf = Pdf::loadView('reports.pdf', compact(
            'products',
            'transactions',
            'stockOpnames',
            'type',
            'startDate',
            'endDate'
        ));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->download(
            'laporan-stockify-'
            . now()->format('Y-m-d-His')
            . '.pdf'
        );
    }

    /**
     * Validasi filter laporan.
     */
    private function validatedFilters(Request $request): array
    {
        $validated = $request->validate([
            'type' => ['nullable', 'in:in,out'],
            'start_date' => ['nullable', 'date'],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
        ]);

        return [
            'type' => $validated['type'] ?? null,
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
        ];
    }

    /**
     * Terapkan filter tanggal pada query.
     */
    private function applyDateFilter(
        $query,
        string $column,
        ?string $startDate,
        ?string $endDate
    ): void {
        if ($startDate) {
            $query->whereDate($column, '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate($column, '<=', $endDate);
        }
    }
}
