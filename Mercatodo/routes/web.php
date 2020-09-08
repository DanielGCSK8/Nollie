<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\User;

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
Route::put('/{id}/restore', 'AdminController@restore')->name('users.restore');


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

route::resource('admin/users', 'AdminController');
route::resource('products', 'ProductController');
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

Route::get('order-detail', [
    'as' => 'order-detail',
    'uses' => 'CartController@orderDetail'
]);





