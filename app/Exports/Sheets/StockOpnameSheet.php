<?php

namespace App\Exports\Sheets;

use App\Models\StockOpname;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class StockOpnameSheet implements FromCollection, WithHeadings, WithTitle
{
    protected ?string $startDate;
    protected ?string $endDate;

    public function __construct(
        ?string $startDate = null,
        ?string $endDate = null
    ) {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = StockOpname::with(['product', 'user'])
            ->latest('opname_date')
            ->latest();

        // FILTER TANGGAL MULAI
        if ($this->startDate) {
            $query->whereDate(
                'opname_date',
                '>=',
                $this->startDate
            );
        }

        // FILTER TANGGAL AKHIR
        if ($this->endDate) {
            $query->whereDate(
                'opname_date',
                '<=',
                $this->endDate
            );
        }

        return $query->get()->map(function ($opname) {
            return [
                'tanggal' => $opname->opname_date
                    ? Carbon::parse($opname->opname_date)->format('d/m/Y')
                    : '-',
                'produk' => $opname->product->name ?? '-',
                'stok_sistem' => $opname->system_stock,
                'stok_fisik' => $opname->physical_stock,
                'selisih' => $opname->difference,
                'petugas' => $opname->user->name ?? '-',
                'catatan' => $opname->note ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Produk',
            'Stok Sistem',
            'Stok Fisik',
            'Selisih',
            'Petugas',
            'Catatan',
        ];
    }

    public function title(): string
    {
        return 'Stock Opname';
    }
}
