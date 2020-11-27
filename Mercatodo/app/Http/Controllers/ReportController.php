<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\Model\Product;
use App\Model\User;
use App\Model\Order;
use App\Jobs\NotifyCompletedReports;


class ReportController extends Controller
{

  public function __construct()
  {
      
      $this->middleware('product');
  }


    public function ProductsMoreSelling()
    {
      $Products = Product::orderBy('sold','desc')->get(['id','name','price','category_id','sold']);

      $pdf = PDF::loadView('reports.moreSelling', compact('Products'));
      NotifyCompletedReports::dispatch(request()->user());

      return $pdf->download('productsMoreSelling.pdf');
      


    }

    public function ClientsMoreActive()
    {

       $clients = DB::table('users as u')
       ->join('orders as o', 'u.id', '=', 'o.user_id')
       ->select('u.id', 'u.name', 'u.cellphone', 'u.email', DB::raw("count('o.user_id') as cant_orders"))
       ->groupBy('o.user_id')          
       ->orderBy('cant_orders', 'desc')
       ->get();

       $pdf = PDF::loadView('reports.clientsMoreActive', compact('clients'));
       NotifyCompletedReports::dispatch(request()->user());

       return $pdf->download('clientsMoreActive.pdf');

    }
}
