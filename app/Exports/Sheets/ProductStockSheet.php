<?php

namespace App\Exports\Sheets;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductStockSheet implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Product::with('category')
            ->orderBy('name')
            ->get()
            ->map(function ($product) {
                return [
                    'produk' => $product->name,
                    'kategori' => $product->category->name ?? '-',
                    'stok' => $product->stock,
                    'harga_beli' => $product->purchase_price,
                    'harga_jual' => $product->selling_price,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Kategori',
            'Stok',
            'Harga Beli',
            'Harga Jual',
        ];
    }

    public function title(): string
    {
        return 'Stok Produk';
    }
}