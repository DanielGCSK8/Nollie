@extends('layouts.app')
@section('content')


<center>
    <h2 style="font-family: Times New Roman;">Productos</h2>
</center>

<br>

  
        <div class="container">
        <table class="table table-bordered">
    
      <tr>
          
          <th>Nombre</th>
          <th>Imágen</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Descripción</th>
          <th>Categoría</th>
          <th>Creado</th>
          <th>Actualizado</th>
          <th>Opciones</th>
      </tr>
    @if($Products)
        @foreach ($Products as $products)
            
        
      <tr>
      <td>{{$products->name}}</td>
      <td style="width:15%;"><img style="max-width:40%;width:auto;height:auto;" src="images/{{ $products->image }}"></td>
      <td>${{number_format($products->price) }}</td>
      <td>{{ $products->quantity }}</td>
      <td>{{ $products->description }}</td>
      
      <td>{{ $products->category->name}}</td>
     
      <td>{{$products->created_at}}</td>
      <td>{{$products->updated_at}}</td>
      <td>
        <a href="{{route('products.edit', $products->id)}}"> <button type="button" class="btn btn-primary">Editar</button>  </a>
        
      </td>

      <td>
        @if(!$products->trashed())
        <form action="{{route('products.destroy', $products->id)}}" method="POST">
          @method('DELETE')
          @csrf
        <button type="submit" class="btn btn-primary">Inhabilitar</button>
      </form>
      @endif
      
      @if($products->trashed())
      <form action="{{route('products.restore', $products->id)}}" method="GET">
        @method('GET')
        @csrf
      <button type="submit" class="btn btn-secondary">Habilitar</button>
      @endif
      </td>

  
     
      </tr>

      @endforeach
    @endif
      

    </table>
    <div class="col-md-12">
        <div class="form-group">
            <a href="{{route('products.create')}}"><button type="submit" name="button" class="btn btn-success">Crear Producto</button> </a>
            <a href="/home"><button type="submit" name="button" class="btn btn-success">Volver</button> </a>
        </div>
      </div>
        </div>
    


@endsection