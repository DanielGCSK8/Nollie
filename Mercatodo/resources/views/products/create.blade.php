@extends('layouts.app')
@section('content')
<form action="{{route('products.store')}}" method="POST" files="true" enctype="multipart/form-data">
@csrf

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group">
            <label for="">Precio</label>
            <input type="text" name="price" value="{{ old('price') }}" class="form-control">
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="">Categoría</label>
            <select class="form-control" name="category_id">
            <option value="">Seleccione</option>
            @foreach($Categories as $categories)
            <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                
            @endforeach
            </select>
            
        </div>
    </div>

    
    <div class="col-md-4">
        <div class="form-group">
            <label for="">Imágen</label>
            <input type="file" name="image" value="" accept=".jpg, .jpeg, .png">
        </div>
    </div>

    <div class="col-md-4">
     <div class="form-group">
        <label for="">Descripción</label>
        <textarea class="form-control" name="description" value="{{ old('description') }}" rows="2"></textarea>
      </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="">Cantidad</label>
            <input type="text" name="quantity" value="{{ old('quantity') }}" class="form-control">
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <button type="submit" name="button" class="btn btn-success">Guardar</button>
        </div>
    </div>
</div>

</form>

@endsection