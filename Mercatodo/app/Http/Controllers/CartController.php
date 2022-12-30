<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Model\Product;
use App\Model\Cart;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(): View
    {
        $idUser = Auth::user()->id;
        $carts = DB::table('carts as c')
            ->join('products as p', 'c.product_id', '=', 'p.id')
            ->join('users as u', 'c.user_id', '=', 'u.id')
            ->select('p.name', 'p.price', 'c.quantity', 'p.image', 'p.id', 'c.cart_id')
            ->where('u.id', '=', $idUser)
            ->get();
        $total = $this->total($carts);


        return view('cart.add', compact('carts', 'total'));
    }

    public function add(Product $product): RedirectResponse
    {
        $idUser = Auth::user()->id;
        $cart = new Cart();
        $carts = DB::table('carts as c')
            ->select('c.product_id', 'cart_id', 'quantity', 'c.user_id')
            ->where('c.product_id', '=', $product->id)
            ->where('c.user_id', '=', $idUser)
            ->get();
          
        if ($carts->isEmpty()) {
            $cart->product_id = $product->id;
            $cart->user_id = Auth::user()->id;
            $cart->quantity = 1;
            $cart->save();

            return redirect()->route('cart-show');
        } 
        else {
            foreach($carts as $c){
                $cart = Cart::findOrFail($c->cart_id);
                $cart->quantity = ($c->quantity = $c->quantity + 1);
                $cart->update();
                return redirect()->route('cart-show');
            }
        }
    }

    public function delete(int $id): RedirectResponse
    {
        $carts = Cart::findOrFail($id);
        $carts->delete();

        return redirect()->route('cart-show');
    }

    public function update($id, $quantity): RedirectResponse
    {
        $carts = Cart::findOrFail($id);
        $carts->quantity = $quantity;
        $carts->update();


        return redirect()->route('cart-show');
    }

    public function trash(): RedirectResponse
    {
        $idUser = Auth::user()->id;
        Cart::where('user_id', $idUser)->delete();

        return redirect()->route('cart-show');
    }

    public function total($carts): int
    {
        $total = 0;
        foreach ($carts as $item) {
            $total += $item->price * $item->quantity;
        }
        return $total;
    
    }
    public function shopping($id): View
    {
        $product = Product::find($id);
        return view('cart.shopping', compact('product'));
    }

    public function orderDetail(): View
    {
        $idUser = Auth::user()->id;
        $cart = DB::table('carts as c')
            ->join('products as p', 'c.product_id', '=', 'p.id')
            ->join('users as u', 'c.user_id', '=', 'u.id')
            ->select('p.name', 'p.price', 'c.quantity')
            ->where('u.id', '=', $idUser)
            ->get();
        
        $total = $this->total($cart);

        return view('cart.order-detail', compact('cart', 'total'));
    }


}