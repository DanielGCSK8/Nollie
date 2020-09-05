@extends('layouts.app')
@section('content')


<h3 style="font-family: Times New Roman">Editar producto</h3>
@if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                  </div>
                    @endif


<form action="{{route('products.update', $Products->id)}}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
<div class="row">
    <div class="col-md-4">

        
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="name" value="{{ $Products->name }}" class="form-control">
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group">
            <label for="">Precio</label>
            <input type="text" name="price" value="{{ $Products->price }}" class="form-control">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="">Categoría</label>
            <select class="form-control" name="category_id">
            <option value="">Seleccione</option>  
            @foreach($Categories as $category)
            <option {{ $category->id == $Products->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                
            @endforeach
            </select>
            
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="">Imágen</label>
            <br/>
          
            <img style="width:200px" src="/images/{{ $Products->image }}">

            <br/>
            <input type="file" name="image" id="image" value="" accept=".jpg, .jpeg, .png">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
           <label for="">Descripción</label>
           <textarea class="form-control" name="description" value="{{ $Products->description }}" rows="2"></textarea>
         </div>
       </div>

    <div class="col-md-12">
        <div class="form-group">
            <button type="submit" name="button" class="btn btn-success">Modificar</button>
            <a class="btn btn-primary" href="/products">Volver</a>
        
        </div>
    </div>

</div>
</form>



@endsection