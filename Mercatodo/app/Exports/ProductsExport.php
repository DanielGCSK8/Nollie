<?php

namespace App\Exports;

use App\Model\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ProductsExport implements FromQuery, ShouldQueue
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Builder
    */
    public function query(): Builder
    {
        return Product::query();
    }
}
