<?php

namespace App\Exports;

use App\Model\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromQuery, ShouldQueue, WithHeadings 
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Builder
    */
    public function query(): Builder
    {
        return Product::query();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'id',
            'name',
            'price',
            'sold',
            'category_id',
            'deleted_at',
            'created_at',
            'updated_at',
            'image',
            'quantity',
            'description',
        ];
    }
}
