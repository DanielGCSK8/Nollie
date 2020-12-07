<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
</head>
<body>
  <style>
    .table{
      width: 100%;
      border: 1px solid #999999;

    }
  </style>
  <center>
<h3 style="font-family: Times New Roman">Productos más vendidos</h3>

  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Categoría</th>
        <th>Cantidad vendida</th>
      </tr>
    </thead>
    <tbody>
      @foreach($Products as $products)
      <tr>
        <td><center>{{ $products->id }}</td>
        <td><center>{{ $products->name }}</td>
        <td><center>{{ $products->price }}</td>
        <td><center>{{ $products->category->name }}</td>
        <td><center>{{ $products->sold }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  
</body>
</html>