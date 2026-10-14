<?php

namespace App\Exports\Sheets;

use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class TransactionsSheet implements FromCollection, WithHeadings, WithTitle
{
    protected ?string $type;
    protected ?string $startDate;
    protected ?string $endDate;

    public function __construct(
        ?string $type = null,
        ?string $startDate = null,
        ?string $endDate = null
    ) {
        $this->type = $type;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = Transaction::with(['product', 'supplier'])
            ->latest('transaction_date')
            ->latest();

        // FILTER JENIS TRANSAKSI
        if (in_array($this->type, ['in', 'out'], true)) {
            $query->where('type', $this->type);
        }

        // FILTER TANGGAL MULAI
        if ($this->startDate) {
            $query->whereDate(
                'transaction_date',
                '>=',
                $this->startDate
            );
        }

        // FILTER TANGGAL AKHIR
        if ($this->endDate) {
            $query->whereDate(
                'transaction_date',
                '<=',
                $this->endDate
            );
        }

        return $query->get()->map(function ($transaction) {
            return [
                'tanggal' => $transaction->transaction_date
                    ? Carbon::parse($transaction->transaction_date)
                        ->format('d/m/Y')
                    : '-',

                'produk' => $transaction->product->name ?? '-',

                'jenis' => $transaction->type === 'in'
                    ? 'Barang Masuk'
                    : 'Barang Keluar',

                'jumlah' => $transaction->quantity,

                'supplier' => $transaction->supplier->name ?? '-',

                'keterangan' => $transaction->description ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Produk',
            'Jenis Transaksi',
            'Jumlah',
            'Supplier',
            'Keterangan',
        ];
    }

    public function title(): string
    {
        return 'Transaksi';
    }
}
