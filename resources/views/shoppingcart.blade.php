@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Shoppingcart</div>

                    <div class="card-body">
                        @if(Session::get('cart'))
                            <ul class="list-group">
                                @foreach($cart as $item)
                                <li class="list-group-item">
                                    <div class="container-flex">
                                        <div class="row">
                                            {{ Form::open(array('url' => "/cart/quantity/")) }}
                                                <input type="number" name="quantity" value="{{$item->get_quantity()}}">
                                                <input type="hidden" name="item_id" value="{{$item->get_item_id()}}">
                                            {{ Form::close() }}
                                            <!--div class="col-3"><div class="form-group"><input type="number" value="{{$item->get_quantity()}}" onchange="set_quantity({{$item->get_item_id()}})" id="item_input_{{$item->get_item_id()}}"></div></div-->
                                            <div class="col-sm"><a href="/product/{{$item->get_item_id()}}">{{$item->get_name()}}</a></div>
                                            @if($item->get_quantity() == 1)
                                                <div class="col-sm text-right">&euro;{{number_format($item->get_price(), 2, ',', '.')}}</div>
                                            @else
                                                <div class="col-sm text-right">(&euro;{{number_format($item->get_price(), 2, ',', '.')}}) &euro;{{number_format($item->get_total_price(), 2, ',', '.')}}</div>
                                            @endif
                                            <div class="col text-right">
                                                {{ Form::open(array('url' => "/cart/remove")) }}
                                                    <input type="hidden" name="item_id" value="{{$item->get_item_id()}}">
                                                    <input type="submit" value="X">
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <div class="row">
                                <div class="col">
                                    <p class="text-left">Total Price:</p>
                                </div>
                                <div class="col">
                                    <p class="text-right">&euro; {{number_format($total, 2, ',', '.')}}</p>
                                </div>
                            </div>
                                @guest
                                    <p class="text-right"><button class="btn btn-disabled" disabled>Log in to order!</button></p>
                                @else
                                <p class="text-right">
                                    {{ Form::open(array('url' => "/order/add")) }}
                                    <input type="hidden" name="cart" value="test">
                                    <input type="submit" value="Order">
                                    {{ Form::close() }}
                                </p>
                                @endguest
                            <hr>
                            <p class="text-right"><a href="/cart/clear" style="color:red;">Clear shopping cart <span class="fa fa-trash-alt"></span></a></p>
                        @else
                            <p>No items!</p>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
