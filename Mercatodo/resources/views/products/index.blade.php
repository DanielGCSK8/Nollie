@extends('layouts.app')
@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

@if ( session('success'))

      <div class="container py-2">
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
              </button>
              <strong>{{__('Success!')}}</strong> {{ session('success') }}
          </div>
      </div>

  @endif
    
        <div class="container">
          <div class="panel panel-default">
              <div class="panel-heading">
                <h3 style="font-family: Times New Roman">Productos</h3>
              </div>
              <div class="panel-body">
                  <table class="table-latitude">
                       
                        <thead>
                          <th>Nombre</th>
                          <th>Imágen</th>
                          <th>Precio</th>
                          <th>Cantidad</th>
                          <th>Descripción</th>
                          <th>Categoría</th>
                          <th>Creado</th>
                          <th>Actualizado</th>
                          <th>Opciones</th>
                      </thead>
                      <tfoot>
                          <tr>
                              <td colspan=3> 
                                <a href="{{route('products.create')}}"><button type="submit" name="button" class="btn btn-success">Crear Producto</button> </a>
                                <a href="/home"><button type="submit" name="button" class="btn btn-success">Volver</button> </a>
                                
                              </td>
                          </tr>
                      </tfoot>
                      <tbody>
                      @if($Products)
                        @foreach ($Products as $products)
                      
                          <tr>
                              <th>{{$products->name}}</th>
                              <td>
                                <center>
                                <img style="max-width:40%;width:auto;height:auto;" src="images/{{ $products->image }}"></td>
                              <td>${{number_format($products->price) }}</td>
                              <td>{{ $products->quantity }}</td>
                              <td>{{ $products->description }}</td>
                              <td>{{ $products->category->name}}</td>
                              <td>{{$products->created_at}}</td>
                              <td>{{$products->updated_at}}</td>
                              <td>
                                <center>
                                <a href="{{route('products.edit', $products->id)}}"> <i class="fas fa-edit"></i></a>

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
                         
                         
                      </tbody>
                  </table>
                  <br>
                  <a href="{{ route('exportProducts') }}"><button type="submit" name="button" class="btn btn-success">Exportar excel</button> </a>
                  <a href="{{route('pdf')}}"><button type="submit" name="button" class="btn btn-success">Productos más vendidos</button> </a>
                  <a href="{{route('clientsActive')}}"><button type="submit" name="button" class="btn btn-success">Clientes más activos</button> </a>
                   
                  <form action="{{ route('importProducts') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <br>
                  <input type="file" name="file" value="" accept=".xlsx">
                  <button type="submit" class="btn btn-success">Importar</button>
                  @if ( session('message'))

      <div class="container py-2">
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
              </button>
              <strong>{{__('Success!')}}</strong> {{ session('success') }}
          </div>
      </div>

                   @endif
                  </form>
              </div>
          </div>
      </div>

      


@endsection