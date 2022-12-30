<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
   public function payment(): RedirectResponse
   {
    $login     = config('placetopay.authId');
    $secretKey = config('placetopay.secretKey');
    $seed      = date('c');

    // 411794
    if (function_exists('random_bytes')) {
        $nonce = bin2hex(random_bytes(16));
    } elseif (function_exists('openssl_random_pseudo_bytes')) {
        $nonce = bin2hex(openssl_random_pseudo_bytes(16));
    } else {
        $nonce = mt_rand();
    }

    $nonceBase64 = base64_encode($nonce);

    $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

    $client = new Client([
               'base_uri' => config('placetopay.baseUrl')
            ]);

   
    $total = 0;
    $cart = $this->obtenerDatos();
        foreach($cart as $item){
            $total += $item->price * $item->quantity;
        }

      $response = $client->post('api/session', 
         [
             'json' => [
                'auth' => [
                    "login"   => $login,
                     "seed"    => $seed,
                     "nonce"   => $nonceBase64,
                     "tranKey" => $tranKey
                 ],
                 'payment' => [
                     'reference' => 1,
                     'description' => 'Pago básico de prueba',
                     'amount' => [
                         'currency' => 'COP',
                         'total' => $total    
                         ]
                     ],
                 'expiration' => date('c', strtotime('+2 days')),
                 'returnUrl' => route('status'),
                 'ipAddress' => request()->getClientIp(),
                 'userAgent' => request()->header('User-Agent')
            ]
        ]
     );

    $response = json_decode($response->getBody()->getContents());
    $requestId = $response->requestId;

   \Session::put('requestId', $requestId);

    return redirect()->away($response->processUrl);
 
        $response = $client->post('api/session/' . $requestId, 
        [
            'json' => [
                'auth' => [
                    "login"   => $login,
                    "seed"    => $seed,
                    "nonce"   => $nonceBase64,
                    "tranKey" => $tranKey
                ]
            ]
        ]);

      
    
 }


   public function status(): RedirectResponse
   {
    $login     = config('placetopay.authId');
    $secretKey = config('placetopay.secretKey');
    $seed      = date('c');

    
    if (function_exists('random_bytes')) {
        $nonce = bin2hex(random_bytes(16));
    } elseif (function_exists('openssl_random_pseudo_bytes')) {
        $nonce = bin2hex(openssl_random_pseudo_bytes(16));
    } else {
        $nonce = mt_rand();
    }

    $nonceBase64 = base64_encode($nonce);

    $tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

    $client = new Client([
               'base_uri' => config('placetopay.baseUrl')
            ]);

    $requestId = \Session::get('requestId');
    \Session::forget('requestId'); 
          
    $response = $client->post('api/session/' . $requestId, 
        [
            'json' => [
                'auth' => [
                    "login"   => $login,
                    "seed"    => $seed,
                    "nonce"   => $nonceBase64,
                    "tranKey" => $tranKey
                ]
            ]
        ]);

        $response = json_decode($response->getBody()->getContents());
        

    if($response->status->status == 'APPROVED'){
        
        $this->saveOrder();
        \Session::forget('cart');
        return \Redirect::route('home')
        ->with('message', 'La compra fue satisfactoria');
        
    }else{
        if($response->status->status == 'REJECTED'){
            return \Redirect::route('home')
        ->with('message', 'La compra fue rechazada');
        }else{
            if($response->status->status == 'PENDING'){
                return \Redirect::route('home')
            ->with('message', 'La compra está pendiente');
            }
    }
    }

    
    
 }

 protected function saveOrder(): Void
 {
  $cart = \Session::get('cart');
  $total = 0;
      foreach($cart as $item){
          $id=$item->id;
          $total += $item->price * $item->quantity;
      }

      $order = Order::create([
          'amount' => $total,
          'user_id'=> \Auth::user()->id

      ]);

      foreach($cart as $product){
          $this->saveOrderDetail($product, $order->id);
          $this->saveSold($product);
      }
 }

  
 protected function saveOrderDetail($product, $order_id): Void
 {
     OrderDetail::create([
         'order_id' => $order_id,
         'products_id' => $product->id,
         'price' => $product->price,
         'quantity' => $product->quantity

     ]);
 }

 protected function saveSold($product): Void
 {
     $Products = Product::where('id', $product->id)->get();
     foreach($Products as $prod){
         $prod->sold = ($prod->sold) + $product->quantity;
         $prod->save();
     }

 }

 public function obtenerDatos()
 {
    $idUser = Auth::user()->id;
    $cart = DB::table('carts as c')
        ->join('products as p', 'c.product_id', '=', 'p.id')
        ->join('users as u', 'c.user_id', '=', 'u.id')
        ->select('p.name', 'p.price', 'c.quantity')
        ->where('u.id', '=', $idUser)
        ->get();
        return $cart;
 }

}