@extends('layouts.app')

@section('content')


@if($Products)
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="/home" method="GET">
                
                <div class="form-group">
                    <label for="name">Buscar</label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="filter[name]" value="{{ request('filter.name') }}" placeholder="nombre" style="width: 300px; height:30px;">
                    
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>
            <div class="row">
                <div class="col">
                   <div class="btn-group btn-group-sm">
                      <a href="/home" class="btn btn-success"> {{ __('Limpiar')}}</a>
                   </div>
                </div>
            </div>
            <br>
            </form>
        </div>
    </div>
</div>

<div class="container" style="display:flex; flex-flow:wrap;">
        @foreach ($Products as $products)
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
        
                
                <a href="/products/{{ $products->id }}"><img class="card-img-top" style="object-fit: cover; width:100%; height:350px;" src="/images/{{ $products->image }}" alt=""  >  </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $products->name }}</h5>
                    <h5 class="card-title">{{ $products->price }}</h5>
                    
                </div>
            </div>
        </div>
    
        @endforeach
    </div>



    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="container">
    <div class="actions text-center">

     

   

    {{ $Products->links() }}
    </div>
    </div>
@endif
@endsection
