<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\NotifyCompletedExport;
use Illuminate\Http\RedirectResponse;

class ExportController extends Controller 
{
    public function __construct()
    {
        
        $this->middleware('product');
    }
    
     /** 
     * @return RedirectResponse
     */
    public function exportProducts(): RedirectResponse
    {
        $fileName = 'products_' . now()->format('Y-m-d') .'.xlsx';
        (new ProductsExport)->queue($fileName, 'exports')->chain([
            new NotifyCompletedExport(request()->user(), $fileName),
        ]);

        return back()->with('success', __('Exportando productos. se te enviará un correo electrónico cuando los productos se hayan exportado.'));
    }
}