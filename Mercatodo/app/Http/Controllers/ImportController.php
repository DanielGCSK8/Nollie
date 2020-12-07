<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Jobs\NotifyCompletedImport;
use App\Http\Requests\ImportRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('product');
    }
    /**
     * Imports a listing of the resource.
     * @param ImportRequest $request
     * @return RedirectResponse | Response
     */
    public function import(ImportRequest $request): RedirectResponse
    {
        (new ProductsImport)->queue($request->file('file'))->chain([
            new NotifyCompletedImport($request->user()),
        ]);
        
        return back()->with('message', __('Importando productos... Se te notificará cuando la importación haya terminado.'));
    }



}