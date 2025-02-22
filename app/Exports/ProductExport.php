<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductExport implements FromCollection, WithColumnFormatting, WithColumnWidths, WithHeadings, WithMapping, WithStyles
{
    public function __construct(protected $products) {}

    public function collection()
    {
        return $this->products;
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Kategori Produk',
            'Harga Beli (Rp)',
            'Harga Jual (Rp)',
            'Stok Produk',
        ];
    }

    public function map($product): array
    {
        return [
            $product->name,
            $product->productCategory->name,
            $product->purchase_price,
            $product->selling_price,
            $product->stock,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 17,
            'C' => 20,
            'D' => 20,
            'E' => 17,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => '#,##0',
            'D' => '#,##0',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getParent()->getActiveSheet()
            ->getProtection()
            ->setPassword('pass1234')
            ->setSheet(true)
            ->setSort(false)
            ->setFormatColumns(false);

        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => 'center',
                ],
            ],
        ];
    }
}
