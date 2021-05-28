<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\Product;
use Illuminate\Support\Facades\Config;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payment;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;


class PaymentsPaypalController extends Controller
{
    private $apiContext;

  public function __construct()
  {
      $payPalConfig = Config::get('paypal');

      $this->apiContext = new ApiContext(
        new OAuthTokenCredential(
            $payPalConfig['client_id'],
            $payPalConfig['client_secret']
        )
    );

  }


  public function createOrder(){
    $cart = \Session::get('cart');
    $total = 0;
        foreach($cart as $item){
            $total += $item->price * $item->quantity;
        }

    $payer = new Payer();
    $payer->setPaymentMethod('paypal');

    $amount = new Amount();
    $amount->setTotal($total);
    $amount->setCurrency('USD');

    $transaction = new Transaction();
    $transaction->setAmount($amount);
    $transaction->setDescription('Pagos de pruebas');

    $callbackUrl = url('paypalStatus');

    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl($callbackUrl)
        ->setCancelUrl($callbackUrl);

    $payment = new Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions(array($transaction))
        ->setRedirectUrls($redirectUrls);

    try {
        $payment->create($this->apiContext);
        return redirect()->away($payment->getApprovalLink());
    } catch (PayPalConnectionException $ex) {
        echo $ex->getData();
    }
  }

  public function paypalStatus(Request $request){
    $paymentId = $request->input('paymentId');
    $payerId = $request->input('PayerID');
    $token = $request->input('token');

    if (!$paymentId || !$payerId || !$token) {
        return \Redirect::route('home')
        ->with('message', 'Lo sentimos! El pago a través de PayPal no se pudo realizar.');
    }

    $payment = Payment::get($paymentId, $this->apiContext);

    $execution = new PaymentExecution();
    $execution->setPayerId($payerId);

    /** Execute the payment **/
    $result = $payment->execute($execution, $this->apiContext);

    if ($result->getState() === 'approved') {
        return \Redirect::route('home')
        ->with('message', 'Gracias! El pago a través de PayPal se ha ralizado correctamente.');
       
    }


  }
    

}