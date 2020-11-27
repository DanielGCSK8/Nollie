<?php

namespace App\Imports;

use App\Model\Product;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, ShouldQueue, WithChunkReading, WithValidation, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    */
    public function model(array $row)
    {
        
        return new Product([
            'name' => $row['name'],
            'price' => $row['price'],
            'category_id' => $row['category_id'],
            'quantity' => $row['quantity'],
            'description' => $row['description'],
        ]);
    }
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5|max:100',
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
