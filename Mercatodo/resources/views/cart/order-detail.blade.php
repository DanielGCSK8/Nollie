@extends('layouts.app')
@section('content')

<div class="container">

    <center>
        <h2 style="font-family: Times New Roman;">Detalle del pedido</h2>
    </center>

</div>


<div class="container">
    <h3 style="font-family: Times New Roman"> Datos del Usuario </h3>

    <table class="table table-bordered">

        <tr><td>Nombre:</td><td>{{ Auth:: user()->name }}</td></tr>
        <tr><td>Correo:</td><td>{{ Auth:: user()->email }}</td></tr>

    </table>
</div>

<div class="container">
    <h3 style="font-family: Times New Roman"> Datos del pedido </h3>

    <table class="table table-bordered">

        <tr>
 
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
        
        </tr>
        @foreach($cart as $item)

        <tr>
            <td>{{ $item->name}}</td>
            <td>${{ number_format($item->price)}}</td>
            <td>{{ $item->quantity}}</td>
            <td>${{ number_format($item->price * $item->quantity)}}</td>

        </tr>

        @endforeach
        
    </table><hr>
    <h3>
        Total: ${{ number_format($total) }}

    </h3><hr>
    <a href="{{ route('cart-show') }}" class="btn btn-success"> Regresar </a>
    <a href="{{ route('confirmation') }}" class="btn btn-success"> Pagar con Place to Pay </a>
    <a href="{{ route('paypal') }}" class="btn btn-success"> Pagar con Paypal </a>
    
 
</div>


@endsection