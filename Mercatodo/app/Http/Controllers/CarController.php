<?php

 if (isset($_GET['btnAdd'])) {
        if (!isset($_COOKIE['cartco'])) {
            $vec=[
        'car'=> array($product->id)
    ];

            setCookie('cartco', json_encode($vec), 0, '/');
            
        } else {
            $carro=json_decode($_COOKIE['cartco']);
            array_push($carro->car, $product->id);
            $vec=[
        'car'=> $carro->car
    ];
            setCookie('cartco', json_encode($vec), 0, '/');
           
        }
    }

    if (isset($_GET['btnDelete'])) {
        $deleteCar = $_GET['btnDelete'];
      $carro=json_decode($_COOKIE['cartco']);
      $arra = array();
      $carro = $carro->car;
      foreach ($carro as $key => $value)
       {
           if($value != $deleteCar)
           {
               array_push($arra, $value);
           }

      }
      $vec=[
        'car'=> $arra
    ];
    
    setCookie('cartco', json_encode($vec), 0, '/');
    ?>
    <script>location.href="compra"</script>
    <?php


    
    }


