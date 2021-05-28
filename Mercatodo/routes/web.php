<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Model\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
   
    
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/{id}/restoreUser', 'AdminController@restoreUser')->name('users.restore');


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

route::resource('admin/users', 'AdminController');
route::resource('products', 'ProductController');
route::resource('orders', 'OrderController');
Route::get('/{id}/restore', 'ProductController@restore')->name('products.restore');

//car



Route::get('cart/show', [
    'as' => 'cart-show',
    'uses' => 'CartController@show'
]);

Route::get('cart/add/{product}', [
        'as' => 'cart-add',
        'uses' => 'CartController@add'
]);

Route::get('cart/delete/{product}', [
        'as' => 'cart-delete',
        'uses' => 'CartController@delete'
]);

Route::get('cart/trash', [
    'as' => 'cart-trash',
    'uses' => 'CartController@trash'
]);

Route::get('cart/update/{product}/{quantity?}', [
    'as' => 'cart-update',
    'uses' => 'CartController@update'
]);

Route::get('shopping/{id}', [
    'uses' => 'CartController@shopping'
]);

Route::get('cart-detail', [
    'as' => 'cart-detail',
    'uses' => 'CartController@orderDetail'
]);

//payments

Route::get('confirmation', [
'as' => 'confirmation',
'uses' => 'PaymentsController@payment'
]);



Route::get('status', [
    'as' => 'status',
    'uses' => 'PaymentsController@status'
    ]);

//PayPal

Route::get('paypal', [
    'as' => 'paypal',
    'uses' => 'PaymentsPaypalController@createOrder'
    ]);

    Route::get('paypalStatus', [
        'as' => 'paypalStatus',
        'uses' => 'PaymentsPaypalController@paypalStatus'
        ]);
    //excel

    Route::get('exportProducts', 'ExportController@exportProducts')->name('exportProducts');
    Route::get('importProducts', 'ImportController@import')->name('importProducts');


    //reports
    Route::get('pdf', 'ReportController@ProductsMoreSelling')->name('pdf');
    Route::get('clientsActive', 'ReportController@ClientsMoreActive')->name('clientsActive');
    





