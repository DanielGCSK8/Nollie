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

<h3 style="font-family: Times New Roman">Clientes más activos</h3>
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Celular</th>
        <th>Email</th>
        <th>Cantidad de Ordenes</th>
      </tr>
    </thead>
    <tbody>
      @foreach($clients as $client)
      <tr>
        <td><center>{{ $client->id }}</td>
        <td><center>{{ $client->name }}</td>
        <td><center>{{ $client->cellphone }}</td>
        <td><center>{{ $client->email }}</td>
        <td><center>{{ $client->cant_orders }}</td>
        
      </tr>
      @endforeach
    </tbody>
  </table>
  
</body>
</html>