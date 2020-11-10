<?php

namespace App\Imports;

use App\Model\Product;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, ShouldQueue, WithChunkReading, WithValidation
{
    use Importable;
    /**
    * @param array $row
    */
    public function model(array $row)
    {
        return new Product([
            'name' => $row[1],
            'price' => $row[2],
            'category_id' => $row[3],
            'quantity' => $row[8],
            'description' => $row[9],
        ]);
    }
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'price' => 'required|numeric|min:1|max:9999999',
            'category_id' => 'required|numeric|exists:categories,id',
            'quantity' => 'required|numeric',
            'description' => 'required',
            
        ];
    }

     /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }
}
