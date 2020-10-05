@extends('layouts.app')

@section('content')

<div class="container py-4">
    <div class="modal-header"><h3>{{__('Orders')}}</h3></div>
        <div class="list-group">
            @foreach($orders as $order)
                <div class="list-group-item my-2">
                    <div class="row font-weight-bold py-2">
                        <div class="col-sm-3">{{__('Nombre')}}</div>
                        <div class="col-sm-3">{{__('Orden creada')}}</div>
                        <div class="col-sm-3">{{__('Cantidad')}}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">{{Auth:: user()->name}}</div>
                        <div class="col-sm-3">{{$order->created_at}}</div>
                        <div class="col-sm-3">
                            ${{number_format($order->amount)}}
                        </div>
                    </div>
              </div>
              @endforeach
        </div>
        
        
</div>
                    

            


@endsection