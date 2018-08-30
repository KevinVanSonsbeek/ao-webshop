@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Orders</div>
                        <ul>
                        @foreach($orders as $order)
                            <li class="list-group-item">
                                <div class="container-flex">
                                    <div class="row">
                                        <div class="col-sm">
                                            <p><a href="/order/{{$order->id}}">Order id: {{$order->id}}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
