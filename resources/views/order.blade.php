@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order</div>
                        <ul>
                        @foreach($order_products as $product)
                            <li class="list-group-item">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm">
                                            <p><a href="/product/{{$product->product()->id}}">{{$product->product()->name}}</a></p>
                                        </div>
                                        <div class="col-sm">
                                            <p>Quanitity: {{$product->quantity}}</p>
                                        </div>
                                        <div class="col-sm">
                                            <p>Price: {{$product->quantity * $product->product()->price}} (p.p. {{$product->product()->price}})</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
