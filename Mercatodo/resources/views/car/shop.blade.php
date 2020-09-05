@extends('layouts.app')
@section('content')

<?php
require app_path(). '\Http\Controllers\CarController.php';



?>
        
        @if(isset($_COOKIE['cartco'])){
        <?php
        $carro=json_decode($_COOKIE['cartco']);
        $vecProducts = $carro->car;
        ?>
        
        <div class="container">
            <h2 style="font-family: Times New Roman;">Productos en su carrito</h2>
        <table class="table table-bordered">
    
      <tr>
          
          <th>Nombre</th>
          <th>Producto</th>
          <th>Subtotal</th>
          <th>Cantidad</th>
          <th>Total</th>
          <th>Quitar</th
          
      </tr>

     <?php
     $sw = false;
     $ids = '(';
     ?>
     @foreach($vecProducts as $prod)
     <?php
     if($sw != false){
      $ids = $ids. ','. $prod;
     }else{
      $ids = $ids. ''. $prod;
      $sw = true;
     }
      
     ?>
     @endforeach
     <?php
     $ids = $ids. ' )';
     $products = DB::select('SELECT id, name, price, image FROM products WHERE id in '. $ids.'');

    
     ?>
  

     @foreach($products as $product)

      <tr>
        <td>{{ $product->name }}</td>
        <td style="width:25%;"><img style="max-width:40%;width:auto;height:auto;" src="/images/{{ $product->image }}"></td>
        <td>{{  $product->price }}</td>
        <td style="width:15%;"><input type="number" value="1" id="quantity" name="quantity" min="1" max="5"></td>
        <td>
         
        </td>
        
        <td>
          <form  name="frmDelete" method="GET">
            @csrf
          <?php
          echo '<button type="submit" name="btnDelete" value="'.$product->id.'" class="btn btn-primary">Eliminar</button>';
          ?>
          </form>
          </td>
        
      
    </tr>
     @endforeach

   
  </table>
  @else
 

  <h1> No hay productos en su carrito <h1>
  @endif
  <a href="/home"><button type="submit" name="button" class="btn btn-success">Volver a la tienda</button> </a>

@endsection