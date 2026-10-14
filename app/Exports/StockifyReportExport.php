<?php

namespace App\Exports;

use App\Exports\Sheets\ProductStockSheet;
use App\Exports\Sheets\TransactionsSheet;
use App\Exports\Sheets\StockOpnameSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StockifyReportExport implements WithMultipleSheets
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

    public function sheets(): array
    {
        return [
            new ProductStockSheet(),
            new TransactionsSheet(
                $this->type,
                $this->startDate,
                $this->endDate
            ),
            new StockOpnameSheet(
                $this->startDate,
                $this->endDate
            ),
        ];
    }
}
