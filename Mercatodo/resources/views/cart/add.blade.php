@extends('layouts.app')
@section('content')


         @if($cart)
        <div class="container">
            <h2 style="font-family: Times New Roman;">Productos en su carrito</h2>
        <table class="table table-bordered">
            <p>
                <a href="{{ route('cart-trash') }}" class="btn btn-danger"> Vaciar Carrito </a>
    
      <tr>
          
          <th>Nombre</th>
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
          <th>Quitar</th

       </tr>
  
     @foreach($cart as $product)

      <tr>
        <td>{{ $product->name }}</td>
        <td style="width:20%;"><img style="max-width:40%;width:auto;height:auto;" src="/images/{{ $product->image }}"></td>
        <td>${{ number_format($product->price) }}</td>
        <td style="width:15%;"><input style="width:30%"type="number" value="{{ $product->quantity }}" id="product_{{ $product->id }}" name="quantity" min="1" max="">
        <a href=""
        class = "btn btn-warning btn-update-item"
        data-href="{{ route('cart-update', $product->id) }}"
        data-id="{{ $product->id }}"
        >
            <i class="fas fa-sync-alt"></i>
        </a>
        
        </td>
        
        
        <td>
            ${{ number_format($product->price * ($product->quantity))}}
        </td>
        
        <td>
          <a class="btn btn-danger" href="{{ route('cart-delete', $product->id) }}">
            <i class="fas fa-trash-alt"></i>
          </a>
          
          </td>
        
      
    </tr>
     @endforeach

   
  </table>
  <hr>
  <h3>
    <span class="col-form-label">
      Total ${{ number_format($total) }}

    </span>
  </h3>
  @else
  

  <h3><span class="label label-warning"> No hay productos en su carrito </span> <h3>
    @endif

    <div>
  <a href="/home"><button type="submit" name="button" class="btn btn-success">Volver a la tienda</button>
   </a>

   <a href="{{ route('order-detail') }}"><button type="submit" name="button" class="btn btn-success">Continuar</button>
   </a>
    </div>
 

@endsection