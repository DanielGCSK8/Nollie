@extends('layouts.app')
@section('content')


<br><br>
<table style="width: 100%; ">

        <tr>
                <td style="width: 50%">
                    <center> 
                        <img class="card-img-top" style="width:400px; height:400px;" src="/images/{{ $product->image }}" alt=""  > 
                    </center>
                </td>
                <td>
                    <div style="width: 50%" >
                    <div style="font-family: Arial;">
                        <h2>{{ $product->name }}
                            </h2></div>
                    <br>
                    <div style="font-size: 15px">Precio: ${{number_format($product->price) }}</div>
                    <div> <p>  {{ $product->description }} </p></div>
                
                        <div style="padding-top: 20px"> 
                    
                            <a href="{{ route('cart-add', $product->id) }}"><button type="submit" class="btn btn-primary">Añadir al carrito</button> </a>

                        </div>
                        

                    </div>

                </td>

        </tr>


</table>




@endsection