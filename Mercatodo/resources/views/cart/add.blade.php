@extends('layouts.app')
@section('content')


         @if($cart)
         <div class="container">
          <div class="panel panel-default">
              <div class="panel-heading">
                <h3 style="font-family: Times New Roman">Productos en su carrito</h3>
              </div>
              <div class="panel-body">
                  <table class="table-latitude">
                       
                        <thead>
                          <th>Nombre</th>
                          <th>Producto</th>
                          <th>Precio</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                          <th>Quitar</th>
                        
                      </thead>
                      <tfoot>
                        
                          <tr>
                              <td colspan=3> 
                                <a href="/home"><button type="submit" name="button" class="btn btn-success">Volver a la tienda</button> </a>
                                <a href="{{ route('order-detail') }}"><button type="submit" name="button" class="btn btn-success">Continuar</button></a>
                                <a href="{{ route('cart-trash') }}" class="btn btn-danger"> Vaciar Carrito </a>
                              </td>
                          </tr>
                      </tfoot>
                      <tbody>
                        @foreach($cart as $product)
                          <tr>
                              <th>{{ $product->name }}</th>
                              <td style="width:20%;">
                                <center>
                                <img style="max-width:40%;width:auto;height:auto;" src="/images/{{ $product->image }}"></td>
                              <td>${{number_format($product->price) }}</td>
                              <td style="width:15%;">
                                <center>
                                <input style="width:30%"type="number" value="{{ $product->quantity }}" id="product_{{ $product->id }}" name="quantity" min="1" max="">
                                <a href=""
                                class = "btn btn-warning btn-update-item"
                                data-href="{{ route('cart-update', $product->id) }}"
                                data-id="{{ $product->id }}"
                                >
                                    <i class="fas fa-sync-alt"></i>
                                </a></td>
    
                              <td>${{ number_format($product->price * ($product->quantity))}}</td>
                              <td>
                                <center>
                                <a class="btn btn-danger" href="{{ route('cart-delete', $product->id) }}">
                                <i class="fas fa-trash-alt"></i>
                              </a>
                              </td>
                              
                          </tr>
                          @endforeach
                         
                      </tbody>
                  </table>
              </div>
          </div>
      </div>    
   
  <div class="container">
  <hr>
  <h3>
    <span class="col-form-label">
      Total ${{ number_format($total) }}

    </span>
  </h3>
</div>
  @else
  
<center>
  <hr>
  <h3 style="font-family: Times New Roman">
    No hay productos en su carrito <h3>
    <a href="/home"><button type="submit" name="button" class="btn btn-success">Volver a la tienda</button> </a>
    </center>
    @endif


    
   

@endsection